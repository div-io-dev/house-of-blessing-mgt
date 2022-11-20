<?php


namespace App\Services;


use App\Models\Class_;

class ClassService
{
    public function create($name){
        $class = Class_::create([
            'name' => $name,
        ]);

        return $class;
    }

    public function update($class, $name){
        $class = $class->update([
            'name' => $name,
        ]);
        return $class;
    }

    public function attachSubjectToClass($class, $subject_id){
        $class->subjects()->syncWithoutDetaching([$subject_id]);
    }

    public function detachSubjectFromClass($class, $subject_id){
        $class->subjects()->detach($subject_id);
    }
}
