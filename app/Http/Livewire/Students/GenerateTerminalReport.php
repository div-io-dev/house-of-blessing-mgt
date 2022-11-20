<?php

namespace App\Http\Livewire\Students;

use App\Models\ClassScore;
use App\Models\Semester;
use Livewire\Component;
use App\Models\Student;

class GenerateTerminalReport extends Component
{
    public Student $student;
    public $subjects = [];
    public Semester $semester;
    public $total_remarks = 0;
    public $bills = [];

    public function render()
    {
        $this->subjects = $this->student->class->subjects;
        foreach ($this->subjects as $subject){
            $class_score = $this->student->classScores
                ->where('subject_id', $subject->id)
                ->where('semester_id', $this->semester->id)->first();
            $this->total_remarks += ($class_score->class_score + $class_score->exam_score);

            $all_class_scores = ClassScore::where('class__id', $this->student->class->id)
                ->where('subject_id', $subject->id)
                ->where('semester_id', $this->semester->id)
                ->get();

            foreach ($all_class_scores as $class_score__){
                $class_score__->total_score = $class_score__->class_score + $class_score__->exam_score;
            }
            $sorted_scores = $all_class_scores->sortByDesc('total_score')->pluck('id')->toArray();

            $class_score->student_position = array_search($class_score->id, $sorted_scores) + 1;


            $subject->class_score = $class_score;
        }
        $this->bills = $this->student->bills()->where('semester_id', $this->semester->id);
        return view('livewire.students.generate-terminal-report');
    }
}
