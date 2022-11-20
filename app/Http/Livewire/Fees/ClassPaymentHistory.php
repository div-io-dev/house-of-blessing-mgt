<?php

namespace App\Http\Livewire\Fees;

use Livewire\Component;
use \App\Models\Fee;
use \App\Models\Class_;

class ClassPaymentHistory extends Component
{
    public Fee $fee;
    public Class_ $class;
    public $semester;
    public $students;
    public $fee_info = [];

    public function render()
    {
        $this->semester = $this->fee->semester;
        $this->students = $this->class->students;
        foreach ($this->students as $student) $student->fee_nfo = studentFeeInfo($this->fee, $student);
        $this->fee_info = feeInfoOfClass($this->fee, $this->class);
        return view('livewire.fees.class-payment-history');
    }
}
