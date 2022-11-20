<?php

namespace App\Models;

use App\Traits\ModelBootingTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Parent_ extends Model
{
    use HasFactory, SoftDeletes, ModelBootingTrait;

    protected $table = "parents";
    protected $guarded = ['id', 'uuid', 'created_at', 'updated_at', 'deleted_at'];

    public function students(){
        return $this->hasMany(Student::class, 'parent__id', 'id');
    }
}
