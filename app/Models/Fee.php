<?php

namespace App\Models;

use App\Traits\ModelBootingTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fee extends Model
{
    use HasFactory, SoftDeletes, ModelBootingTrait;
    protected $guarded = ['id', 'uuid', 'created_at', 'updated_at', 'deleted_at'];
    protected $casts = [
        'items' => 'array',
    ];

    public function classes(){
        return $this->belongsToMany(Class_::class)->withTimestamps()->withPivot(['semester_id']);
    }

    public function semester(){
        return $this->belongsTo(Semester::class);
    }

    public function bills(){
        return $this->hasMany(Bill::class);
    }

}
