<?php

namespace App\Models;

use App\Traits\ModelBootingTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentClassRecord extends Model
{
    use HasFactory, SoftDeletes, ModelBootingTrait;
    protected $guarded = ['id', 'uuid', 'created_at', 'updated_at', 'deleted_at'];
    protected $casts = [
        'semesters' => 'array'
    ];

    public function student(){
        return $this->belongsTo(Student::class);
    }

    public function class(){
        return $this->belongsTo(Class_::class, 'class__id', 'id');
    }

    public function fetchedSemesters() : Attribute {
        $semesters = [];
        if ($this->semesters){
            foreach ($this->semesters as $semester_id){
                $semesters[] = Semester::where('id', $semester_id)->first();
            }
        }
        return new Attribute(
            get: fn() => $semesters
        );
    }

}
