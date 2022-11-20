<?php

namespace App\Models;

use App\Traits\ModelBootingTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use HasFactory, SoftDeletes, ModelBootingTrait;

    protected $guarded = ['id', 'uuid', 'created_at', 'updated_at', 'deleted_at'];

    public function classes(){
        return $this->belongsToMany(Class_::class);
    }

    public function teachers(){
        return $this->belongsToMany(Teacher::class);
    }

    public function classScores(){
        return $this->hasMany(ClassScore::class);
    }
}
