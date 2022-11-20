<?php

namespace App\Models;

use App\Traits\ModelBootingTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassScore extends Model
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

    public function subject(){
        return $this->belongsTo(Subject::class);
    }

    public function totalScore() : Attribute {
        $total = $this->class_score + $this->exam_score;
        return new Attribute(get: fn() => $total);
    }

}
