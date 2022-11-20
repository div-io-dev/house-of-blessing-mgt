<?php

namespace App\Http\Controllers;

use App\Http\Requests\Bill\StoreRequest;
use App\Models\Bill;
use App\Models\BillPayment;
use App\Models\Class_;
use App\Models\Student;
use App\Services\BillService;
use Barryvdh\DomPDF\Facade\Pdf;

class BillController extends Controller
{
    public function store(StoreRequest $request){
        $validatedData = $request->validated();
        if ($validatedData['for'] == 'student'){
            $student = Student::where('student_number', $validatedData['student_number'])->first();
            (new BillService())->store($student, $validatedData['amount'], $validatedData['type']);
        }
        else{
            foreach ($validatedData['selected_classes'] as $class_id){
                $class = Class_::where('id', $class_id)->first();
                foreach ($class->students as $student){
                    (new BillService())->store($student, $validatedData['amount'], $validatedData['type']);
                }
            }
        }
        return back()->with([
            'success' => "Bill created successfully"
        ]);
    }

    public function paymentInvoice(BillPayment $billPayment){
        $pdf = PDF::loadView('PDF.bill_payment_invoice', ['bill' => $billPayment->bill, 'payment' => $billPayment]);
        $file_name = "{$billPayment->bill->billable->full_name}_bill_{$billPayment->id}_invoice.pdfphp artisan ma";
        return $pdf->download($file_name);
    }

    public function billPaymentsInvoice(Bill $bill){
        $pdf = PDF::loadView('PDF.bill_payments_invoice', ['bill' => $bill, 'payments' => $bill->billPayments]);
        $file_name = "{$bill->billable->full_name}_bills_invoice.pdf";
        return $pdf->download($file_name);
    }
}
