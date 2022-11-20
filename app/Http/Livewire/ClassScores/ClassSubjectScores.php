<?php

namespace App\Http\Livewire\ClassScores;

use App\Models\Class_;
use App\Models\ClassScore;
use App\Models\Semester;
use App\Models\Subject;
use Livewire\Component;

class ClassSubjectScores extends Component
{
    public Class_ $class;
    public Subject $subject;
    public Semester $semester;
    public $class_scores;
    public $previous_class_scores;

    public function render()
    {
        $this->class_scores = ClassScore::where('class__id', $this->class->id)
            ->where('subject_id', $this->subject->id)
            ->where('semester_id', $this->semester->id)
            ->get();

        foreach ($this->class_scores as $class_score){
            $class_score->total_score = $class_score->class_score + $class_score->exam_score;
        }
        $sorted_scores = $this->class_scores->sortByDesc('total_score')->pluck('id')->toArray();
        foreach ($this->class_scores as $class_score_){
            $class_score_->student_position = array_search($class_score_->id, $sorted_scores) + 1;
        }

        $this->previous_class_scores = ClassScore::where('class__id', $this->class->id)
            ->where('subject_id', $this->subject->id)
            ->where('semester_id', '!=', $this->semester->id)
            ->get()
            ->groupBy('semester_id')->toBase();
        return view('livewire.class-scores.class-subject-scores');
    }
}
