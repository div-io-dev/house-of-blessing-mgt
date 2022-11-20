<?php

namespace App\Models;

use App\Traits\ModelBootingTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Class_ extends Model
{
    use HasFactory, SoftDeletes, ModelBootingTrait;

    protected $guarded = ['id', 'uuid', 'created_at', 'updated_at', 'deleted_at'];

    public function students(){
        return $this->hasMany(Student::class, 'class__id', 'id');
    }

    public function teachers(){
        return $this->belongsToMany(Teacher::class)->withTimestamps()->withPivot('subject_id');
    }

    public function classSemesterRecords(){
        return $this->hasMany(StudentClassSemesterRecord::class);
    }

    public function studentClassRecords(){
        return $this->hasMany(StudentClassRecord::class, 'class_id', 'id');
    }

    public function subjects(){
        return $this->belongsToMany(Subject::class)->withTimestamps();
    }

    public function fees(){
        return $this->belongsToMany(Fee::class)->withTimestamps()->withPivot(['semester_id']);
    }

    public function classScores(){
        return $this->hasMany(ClassScore::class);
    }

}
