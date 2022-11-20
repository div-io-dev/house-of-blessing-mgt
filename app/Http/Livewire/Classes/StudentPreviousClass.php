<?php

namespace App\Http\Livewire\Classes;

use App\Models\Student;
use App\Models\StudentClassRecord;
use Livewire\Component;

class StudentPreviousClass extends Component
{
    public Student $student;
    public StudentClassRecord $studentClassRecord;
    public  $class;

    public function render()
    {
        $this->class = $this->studentClassRecord->class;
        return view('livewire.classes.student-previous-class');
    }
}
