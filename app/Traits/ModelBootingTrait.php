<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Support\Str;

trait ModelBootingTrait
{
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model){
            $model->added_by_id = auth()->check() ? auth()->user()->id : null;
            $model->uuid = Str::uuid()->toString();
        });
    }

    public function addedBy(){
        return $this->belongsTo(User::class, 'added_by_id', 'id');
    }

    public function getFormattedCreatedAtAttribute() {
        return date('D, jS M Y',strtotime($this->created_at));
    }

    public function getAddedByNameAttribute() {
        return $this->addedBy->name;
    }

}
