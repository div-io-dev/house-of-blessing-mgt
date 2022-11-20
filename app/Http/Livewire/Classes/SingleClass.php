<?php

namespace App\Http\Livewire\Classes;

use App\Models\Class_;
use App\Models\Subject;
use App\Models\Teacher;
use App\Services\ClassService;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class SingleClass extends Component
{
    use LivewireAlert;

    public Class_ $class;
    public $class_name;
    public $other_classes;
    public $subjects;
    public $subject_to_attach;
    public $subject_to_detach;
    public $class_teachers = [];
    public $class_subjects;
    public $teachers;
    public $class_students;

    public function render()
    {
        $this->class_name = $this->class->name;


        // find student position
        $this->class_students = $this->class->students;
        foreach ($this->class_students as $student){
            $total_score = $student->classScores->where('class__id', $this->class->id)->sum('total_score');
            $student->total_score = $total_score;
        }
        $sorted_std_scores = $this->class_students->sortByDesc('total_score')->pluck('id')->toArray();
        foreach ($this->class_students as $student_){
            $student_->class_position = array_search($student_->id, $sorted_std_scores) + 1;
        }


        $this->subjects = $this->externalSubjects();
        foreach ($this->class->teachers as $teacher){
            $this->class_teachers[$teacher->id] = $teacher;
        }
        $this->class_subjects = $this->class->subjects;
        $this->other_classes = Class_::where('id', '!=', $this->class->id)->get();
        foreach ($this->class_subjects as $subject){
            $subject->teacher = getTeacherOfClassAndSubject(class: $this->class, subject: $subject);
        }
        $this->teachers = Teacher::all();
        return view('livewire.classes.single-class');
    }

    public function updateClass(){
        $this->validate([
            'class_name' => ['required', 'string', Rule::unique('class_', 'name')->ignore($this->class->id)],
        ]);
        $class = (new ClassService())->update($this->class, $this->class_name);
        $this->alert(message: "Class updated successfully");
    }

    public function attachSubject(){
        $this->validate([
            'subject_to_attach' => ['required', 'exists:subjects,id'],
        ]);
        if(!currentSemester()){
            $this->alert(type: 'error', message: "Please create a semester");
            return;
        }
        (new ClassService())->attachSubjectToClass(class: $this->class, subject_id: $this->subject_to_attach);
        // create class scores for students
        createSubjectClassScores($this->subject_to_attach, $this->class);
        $this->subjects->forget($this->subject_to_attach);
        $this->alert(message: "New subject has been attached to this class");
    }

    public function detachSubject(){
        $this->validate([
            'subject_to_detach' => ['required', 'exists:subjects,id'],
        ]);
        (new ClassService())->detachSubjectFromClass($this->class, $this->subject_to_detach);
        // clear class scores of students
        clearSubjectClassScores($this->subject_to_detach, $this->class);
        $this->subjects = $this->externalSubjects();
        $this->alert(message: "A subject has been detached from this class");
    }

    private function externalSubjects(){
        return Subject::whereNotIn('id', $this->class->subjects->pluck('id'))->get();
    }
}
