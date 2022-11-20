<?php

namespace App\Models;

use App\Traits\ModelBootingTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
    use HasFactory, SoftDeletes, ModelBootingTrait;

    protected $guarded = ['id', 'uuid', 'created_at', 'updated_at', 'deleted_at'];
    protected $appends = [
        'full_name', 'amount_owing',
    ];

    public function bills()
    {
        return $this->morphToMany(Bill::class, 'billable');
    }

    public function classes(){
        return $this->belongsToMany(Class_::class)->withTimestamps()->withPivot('subject_id');
    }

    public function fullName() : Attribute {
        return new Attribute(
            get: fn() => "$this->name"
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
        return new Attribute(get: fn() => url('/').'/'.$this->certificate_path);
    }

    public function certificateImageUrl() : Attribute {
        return new Attribute(get: fn() => url('/').'/'.$this->profile_image_path);
    }

}
