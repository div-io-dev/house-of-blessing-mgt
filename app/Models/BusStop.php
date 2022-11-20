<?php

namespace App\Models;

use App\Traits\ModelBootingTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusStop extends Model
{
    use HasFactory, SoftDeletes, ModelBootingTrait;
    protected $guarded = ['id', 'uuid', 'created_at', 'updated_at', 'deleted_at'];

    public function students(){
        return $this->hasMany(Student::class);
    }

    public function totalRevenue() : Attribute {
        $total_revenue = $this->price * count($this->students);
        return new Attribute(get: fn() => $total_revenue);
    }

}
