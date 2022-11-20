<?php

namespace App\Http\Livewire\Fees;

use App\Models\Bill;
use App\Models\Bill as BillModel;
use App\Models\Student;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Arhinful\LaravelMnotify\MNotify;

class Feepayment extends Component
{
    use LivewireAlert;

    public $student_number;
    public $amount;
    public $payer_name;
    public $payer_mobile_number;
    public $student_bills = [];
    public $student_name_n_class = '';
    public $amount_owning = '';

    public function render()
    {
        return view('livewire.fees.feepayment');
    }

    public function pay(){
        $this->validate([
            'student_number' => 'exists:students,student_number',
            'amount' => 'required',
            'payer_name' => 'required|string',
            'payer_mobile_number' => 'nullable|string',
        ]);
        $student = Student::where('student_number', $this->student_number)->first();
        if ($student->amount_owing < 1){
            $this->alert(message: "This student is not owing");
            return;
        }
        $payer = [
            'name' => $this->payer_name,
            'mobile_number' => $this->payer_mobile_number,
        ];
        payStudentFee($student, $this->amount, $payer);
        $this->reset(['amount']);
        $this->student_bills = $this->updateBill($student);
        $this->amount_owning = $student->amount_owing;
        $this->alert(message: "Fees settled successfully");

        //sending bill notification
        $bill = BillModel::all();
        $destinationPhone = $this->payer_mobile_number;
        $amountPaid = $this->amount;


        $sender= new MNotify();
        $sender->sendQuickSMS([$destinationPhone], "Thank you, We have received your payment of GHS$amountPaid for School Fees at House of Blessing School.");



    }

    public function fetchStudentInfo(){
        $this->reset(['student_name_n_class', 'amount_owning', 'student_bills']);
        if (strlen($this->student_number) != 8){
            return;
        }
        $this->validate([
            'student_number' => 'exists:students,student_number',
        ]);
        $student = Student::where('student_number', $this->student_number)->first();
        $this->student_name_n_class = "$student->full_name | {$student->class->name}";
        $this->amount_owning = $student->amount_owing;
        $this->student_bills = $this->updateBill($student);
    }

    private function updateBill($student){
        return Bill::where('billable_id', $student->id)
            ->where('billable_type', get_class($student))
            ->where('type', 'fee')
            ->get();
    }

}
