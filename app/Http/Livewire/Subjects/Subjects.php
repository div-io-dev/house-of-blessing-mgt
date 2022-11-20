<?php

namespace App\Http\Livewire\Subjects;

use App\Models\Subject;
use App\Services\SubjectService;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Subjects extends Component
{
    use LivewireAlert;

    public $subjects;
    public $new_subject_name;
    public $new_subject_code;

    protected $validationAttributes = [
        'new_subject_name' => 'subject name',
        'new_subject_code' => 'subject code',
    ];

    public function render()
    {
        $this->subjects = Subject::all();
        return view('livewire.subjects.subjects');
    }

    public function addSubject(){
        $this->validate([
            'new_subject_name' => 'required|string|unique:subjects,name',
            'new_subject_code' => 'required|string|unique:subjects,code',
        ]);
        $subject = (new SubjectService())->create(name: $this->new_subject_name, code: $this->new_subject_code);
        $this->alert(message: "Subject with the name '$this->new_subject_name' has been created successfully");
        $this->new_subject_name = ""; $this->new_subject_code = "";
    }
}
