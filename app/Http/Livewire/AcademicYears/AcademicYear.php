<?php

namespace App\Http\Livewire\AcademicYears;

use Livewire\Component;
use App\Models\AcademicYear as AcademicYearModel;

class AcademicYear extends Component
{
    public AcademicYearModel $academicYear;

    public function render()
    {
        return view('livewire.academic-years.academic-year');
    }
}
