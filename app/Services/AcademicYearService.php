<?php


namespace App\Services;


use App\Models\AcademicYear;

class AcademicYearService
{
    public function create($data){
        $academic_year = AcademicYear::create([
            'name' => $data['name'],
            'start_date' => formatFrontEndDate($data['start_date']),
            'end_date' => formatFrontEndDate($data['end_date']),
        ]);
        return $academic_year;
    }
}
