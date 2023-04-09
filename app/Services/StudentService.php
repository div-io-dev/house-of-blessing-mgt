<?php


namespace App\Services;


use App\Models\Student;

class StudentService
{
    public function store($data){

        $lastStudent = Student::orderBy('id', 'desc')->first()->student_number ?? 0000;
        $newId = substr($lastStudent,-4);
        //dd($newId);

        $student = Student::create([
            'class__id' => $data['class_'],
            'parent__id' => $data['parent_'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'other_names' => $data['other_names'] ?? null,
            'dob' => formatFrontEndDate($data['dob']),
            'student_number' =>  'HOB'.str_pad($newId +1,4,0, STR_PAD_LEFT),
            'profile_image' => $data['profile_image'] ?? null,
            'bus_stop_id' => $data['bus_stop'] ?? null,
        ]);
        return $student;
    }
}
