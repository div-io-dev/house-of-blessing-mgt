<?php

namespace App\Http\Livewire;

use App\Models\Bill;
use App\Models\Fee;
use App\Models\Semester;
use App\Models\Subject;
use App\Models\Class_;
use App\Models\Student;
use App\Models\Teacher;
use Livewire\Component;

class Dashboard extends Component
{
    public $total_students;
    public $newly_added_students;
    public $total_classes;
    public $newly_added_classes;
    public $total_teachers;
    public $newly_added_teachers;
    public $total_subject;
    public $newly_added_subjects;
    public $total_semesters;
    public $current_semester;
    public $total_bills;
    public $total_fees;

    public function render()
    {
        return view('livewire.dashboard');
    }

    public function mount(){
        $this->total_classes = count(Class_::all());
        $this->total_students = count(Student::all());
        $this->total_teachers = count(Teacher::all());
        $this->total_subject = count(Subject::all());
        $this->total_semesters = count(Semester::all());
        $this->total_bills = count(Bill::all());
        $this->total_fees = count(Fee::all());
        $this->current_semester = Semester::where('is_ended', false)->first();
        if (!$this->current_semester){
            $this->current_semester = Semester::orderBy('end_date', 'DESC')->first();
        }
        $this->newly_added_students = count(Student::whereDate('created_at', today()->subDays(20))->get());
        $this->newly_added_classes = count(Class_::whereDate('created_at', today()->subDays(20))->get());
        $this->newly_added_teachers = count(Teacher::whereDate('created_at', today()->subDays(20))->get());
        $this->newly_added_subjects = count(Subject::whereDate('created_at', today()->subDays(20))->get());
    }
}
