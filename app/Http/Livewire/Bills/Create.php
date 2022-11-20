<?php

namespace App\Http\Livewire\Bills;

use App\Models\Class_;
use App\Models\Student;
use Livewire\Component;

class Create extends Component
{
    public $classes;
    public $student_number;
    public $student_name_n_class;
    public $for = 'student';

    public function render()
    {
        $this->classes = Class_::all();
        return view('livewire.bills.create');
    }

    public function fetchStudentInfo(){
        if (strlen($this->student_number) != 8){
            $this->student_name_n_class = '';
            return;
        }
        $this->validate([
            'student_number' => 'exists:students,student_number',
        ]);
        $student = Student::where('student_number', $this->student_number)->first();
        $this->student_name_n_class = "$student->full_name | {$student->class->name}";
    }
}
