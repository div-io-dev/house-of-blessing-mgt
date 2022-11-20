<?php


namespace App\Services;


use App\Models\Teacher;

class TeacherService
{
    public function create($data){
        $teacher = Teacher::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'mobile_number' => $data['mobile_number'],
            'salary' => $data['salary'],
            'email' => $data['email'] ?? null,
            'certificate' => $data['certificate'],
            'certificate_path' => $data['certificate_path'] ?? null,
            'profile_image_path' => $data['profile_image_path'] ?? null,
        ]);
        return $teacher;
    }

    public function update($teacher, $data){
        $teacher->update($data);
        return $teacher;
    }

}
