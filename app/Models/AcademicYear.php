<?php

namespace App\Models;

use App\Http\Livewire\Fees\Fees;
use App\Traits\ModelBootingTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AcademicYear extends Model
{
    use HasFactory, SoftDeletes, ModelBootingTrait;
    protected $guarded = ['id', 'uuid', 'created_at', 'updated_at', 'deleted_at'];

    public function fees(){
        return $this->hasMany(Fees::class);
    }
}
