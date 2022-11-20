<?php


namespace App\Services;


use App\Models\Student;

class StudentService
{
    public function store($data){
        $student = Student::create([
            'class__id' => $data['class_'],
            'parent__id' => $data['parent_'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'other_names' => $data['other_names'] ?? null,
            'dob' => formatFrontEndDate($data['dob']),
            'student_number' => generateUniqueNumber("App\Models\Student", "student_number"),
            'profile_image' => $data['profile_image'] ?? null,
            'bus_stop_id' => $data['bus_stop'] ?? null,
        ]);
        return $student;
    }
}
