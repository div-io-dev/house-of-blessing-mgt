<?php

namespace App\Http\Livewire\AcademicYears;

use App\Services\AcademicYearService;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use App\Models\AcademicYear;

class AcademicYears extends Component
{
    use LivewireAlert;

    public $academicYears;
//    public $new_ay_name;
    public $new_ay_start_date;
    public $new_ay_end_date;

    public function render()
    {
        $this->academicYears = AcademicYear::all();
        return view('livewire.academic-years.academic-years');
    }
    public function mount(){

    }

    public function addAcademicYear(){
        $this->validate([
            'new_ay_start_date' => 'required',
            'new_ay_end_date' => 'required',
        ]);
        $name = formatFrontEndDate($this->new_ay_start_date, 'Y')."/".formatFrontEndDate($this->new_ay_start_date, 'Y'). " Academic Year";
        $data = [
            'name' =>  $name,
            'start_date' => $this->new_ay_start_date,
            'end_date' => $this->new_ay_end_date
        ];
        $ay = (new AcademicYearService())->create($data);
        $this->alert(message: "Academic Year created successfully");
        $this->reset(['new_ay_start_date', 'new_ay_end_date']);
    }
}
