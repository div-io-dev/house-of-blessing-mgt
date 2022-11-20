<?php


namespace App\Services;


use App\Models\Semester;

class SemesterService
{
    public function create($data){
        endPreviousSemesters();
        $semester = Semester::create($data);
        // create class scores for all students
        createSemesterClassScores($semester);
        // create student class semester record for all students
        createStudentClassSemesterRecord($semester);
        return $semester;
    }

    public function update($semester, $data){
        $semester->update($data);
        return $semester;
    }
}


