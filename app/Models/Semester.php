<?php

namespace App\Models;

use App\Traits\ModelBootingTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Semester extends Model
{
    use HasFactory, SoftDeletes, ModelBootingTrait;
    protected $guarded = ['id', 'uuid', 'created_at', 'updated_at', 'deleted_at'];

    public function fees(){
        return $this->hasMany(Fee::class);
    }

    public function classScores(){
        return $this->hasMany(ClassScore::class);
    }

    public function classSemesterRecords(){
        return $this->hasMany(StudentClassSemesterRecord::class);
    }

    public function bills(){
        return $this->hasMany(Bill::class);
    }

}
