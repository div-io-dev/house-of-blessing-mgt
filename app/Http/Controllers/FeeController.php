<?php

namespace App\Http\Controllers;

use App\Http\Requests\Fees\StoreRequest;
use App\Http\Requests\Fees\UpdateRequest;
use App\Models\Class_;
use App\Models\Fee;
use App\Services\BillService;
use App\Services\FeeService;

class FeeController extends Controller
{

    private FeeService $feeService;

    public function __construct()
    {
        $this->feeService = new FeeService();
    }

    public function store(StoreRequest $request){
        $validatedData = $request->validated();
        $items = json_decode($validatedData['items']);
        $items_total_price = $this->calculateAmount($items);
        $fee_data = [
            'semester_id' => $validatedData['semester'],
            'total_amount' => $items_total_price,
            'items' => $items,
        ];
        $fee = $this->feeService->create($fee_data);

        // bind fees to classes
        foreach ($validatedData['selected_classes'] as $class_id){
            if ($class_id){
                $class = Class_::where('id', $class_id)->first();
                $class->fees()->syncWithPivotValues($fee->id, [
                    'semester_id' => $validatedData['semester'],
                ]);
                // create bills for each student of the class
                foreach ($class->students as $student){
                    (new BillService())->store($student, $items_total_price, 'School Fees', $fee->id);
                }
            }
        }
        return back()->with([
            'success' => "Fee create successfully and students of the selected classes have been billed"
        ]);
    }
    // git remote set-url origin https://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@github.com/div-io-dev/house-of-blessing-mgt.git

    public function update(Fee $fee, UpdateRequest $request){
        $validatedData = $request->validated();
        $items = json_decode($validatedData['items']);
        $existing_classes_ids = json_decode($validatedData['existing_classes_ids']);
        $newly_selected_classes = $validatedData['selected_classes'];


        $items_total_price = $this->calculateAmount($items);
        $fee->update([
            'total_amount' => $items_total_price,
            'items' => $items,
        ]);
        // check if a class was removed and take necessary actions
        foreach ($existing_classes_ids as $existing_class_id){
            $existing_class = Class_::where('id', $existing_class_id)->first();
            if (!in_array($existing_class_id, $newly_selected_classes)){
                $fee->classes()->detach($existing_class_id);
                foreach ($existing_class->students as $student_){
                    $bill = $student_->bills()->where('fee_id', $fee->id)->first();
                    $bill->delete();
                }
            }
        }
        foreach ($newly_selected_classes as $class_id){
            $class = Class_::where('id', $class_id)->first();
            // create bills for each student of the class
            foreach ($class->students as $student){
                if (in_array($class_id, $existing_classes_ids)){
                    $bill = $student->bills()->where('fee_id', $fee->id)->first();
                    $bill->update([
                        'amount' => $items_total_price
                    ]);
                }
                else{
                    (new BillService())->store($student, $items_total_price, 'School Fees', $fee->id);
                }
            }
        }
        return back()->with([
            'success' => "Fee updated successfully"
        ]);
    }

    public function calculateAmount($items){
        $total_amount = 0.00;
        foreach ($items as $item){
            $total_amount += (float) $item->price;
        }
        return $total_amount;
    }
}
