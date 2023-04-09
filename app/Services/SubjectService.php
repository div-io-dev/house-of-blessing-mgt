<?php


namespace App\Services;


use App\Models\Subject;

class SubjectService
{
    public function create($name){
        $subject = Subject::create([
            'name' => $name,
            'code' => rand(000,999),
        ]);
        return $subject;
    }

    public function update($subject, $name, $code){
        $subject = $subject->update([
            'name' => $name,
            'code' => $code,
        ]);
        return $subject;
    }
}
