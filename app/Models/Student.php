<?php

namespace App\Models;

use App\Traits\ModelBootingTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes, ModelBootingTrait;
    protected $guarded = ['id', 'uuid', 'created_at', 'updated_at', 'deleted_at'];
    protected $appends = [
        'full_name', 'amount_owing',
    ];

    public function parent(){
        return $this->belongsTo(Parent_::class, 'parent__id', 'id');
    }

    public function class(){
        return $this->belongsTo(Class_::class, 'class__id', 'id');
    }

    public function busStop(){
        return $this->belongsTo(BusStop::class);
    }

    public function classScores(){
        return $this->hasMany(ClassScore::class);
    }

    public function classRecords(){
        return $this->hasMany(StudentClassRecord::class);
    }

    public function classSemesterRecords(){
        return $this->hasMany(StudentClassSemesterRecord::class);
    }

    public function bills(){
//        return $this->morphToMany(Bill::class, 'billable', 'bills');
        return Bill::where('billable_id', $this->id)
            ->where('billable_type', get_class($this))
            ->get();
    }

    public function fullName() : Attribute {
        return new Attribute(
            get: fn() => "$this->first_name $this->other_names $this->last_name"
        );
    }

    public function amountOwing() : Attribute {
        $sum = Bill::where('billable_id', $this->id)
            ->where('billable_type', get_class($this))
            ->get()
            ->where('amount_left', '>', 0)
            ->sum('amount_left');
        return new Attribute(get: fn() => $sum);
    }

    public function profileImageUrl() : Attribute {
        return new Attribute(get: fn() => url('/').'/'.$this->profile_image);
    }
}
