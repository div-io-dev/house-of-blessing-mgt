<?php

namespace App\Http\Livewire\Students;

use Livewire\Component;
use App\Models\Student;

class Students extends Component
{
    public $students;

    public function render()
    {
        $this->students = Student::orderBy('first_name', 'ASC')->get();
        return view('livewire.students.students');
    }
}
