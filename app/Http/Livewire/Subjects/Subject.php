<?php

namespace App\Http\Livewire\Subjects;

use Livewire\Component;
use App\Models\Subject as SubjectModel;

class Subject extends Component
{
    public SubjectModel $subject;
    public function render()
    {
        return view('livewire.subjects.subject');
    }
}
