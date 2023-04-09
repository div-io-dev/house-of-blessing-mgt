<?php

namespace App\Http\Livewire\Students;

use Livewire\Component;
use App\Models\Student;
use Livewire\WithPagination;

class Students extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
   // public $students;
    public $search = '';

    public function render()
    {
        return view('livewire.students.students',[
           'students' =>  Student::search(trim($this->search))
            ->orderBy('first_name', 'ASC')
            ->paginate()
        ]);
    }



}
