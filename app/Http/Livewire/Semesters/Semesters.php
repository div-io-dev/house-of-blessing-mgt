<?php

namespace App\Http\Livewire\Semesters;

use App\Models\Semester;
use App\Services\SemesterService;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Semesters extends Component
{
    use LivewireAlert;

    public $semesters;
    public $new_semester_name;
    public $new_semester_description;
    public $new_semester_start_date;
    public $new_semester_end_date;


    public function render()
    {
        $this->semesters = Semester::orderBy('created_at', 'DESC')->get();
        return view('livewire.semesters.semesters');
    }

    public function mount()
    {

    }

    public function addSemester()
    {
        $this->validate([
            'new_semester_name' => ['required', 'unique:semesters,name', 'string'],
            'new_semester_description' => ['nullable', 'string'],
            'new_semester_start_date' => ['required', 'date', 'unique:semesters,start_date'],
            'new_semester_end_date' => ['nullable', 'date', 'unique:semesters,end_date'],
        ]);
        $data = [
            'name' => $this->new_semester_name,
            'description' => $this->new_semester_description,
            'start_date' => $this->new_semester_start_date,
            'end_date' => $this->new_semester_end_date,
        ];
        (new SemesterService())->create($data);
        $this->reset([
            'new_semester_name',
            'new_semester_description',
            'new_semester_start_date',
            'new_semester_end_date'
        ]);
        $this->alert(message: "Semester added successfully");
    }

}
