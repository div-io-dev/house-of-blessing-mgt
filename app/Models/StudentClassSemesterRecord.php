<?php

namespace App\Models;

use App\Traits\ModelBootingTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentClassSemesterRecord extends Model
{
    use HasFactory, SoftDeletes, ModelBootingTrait;
    protected $guarded = ['id', 'uuid', 'created_at', 'updated_at', 'deleted_at'];

    public function student(){
        return $this->belongsTo(Student::class);
    }

    public function class(){
        return $this->belongsTo(Class_::class);
    }

    public function semester(){
        return $this->belongsTo(Semester::class);
    }
}
