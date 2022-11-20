<?php


namespace App\Services;


use App\Models\Subject;

class SubjectService
{
    public function create($name, $code){
        $subject = Subject::create([
            'name' => $name,
            'code' => $code,
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
