<?php

namespace App\Models;

use App\Traits\ModelBootingTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bill extends Model
{
    use HasFactory, SoftDeletes, ModelBootingTrait;
    protected $guarded = ['id', 'uuid', 'created_at', 'updated_at', 'deleted_at'];
    protected $appends = ['amount_left', 'formatted_created_at', 'added_by_name'];

    public function billable()
    {
        return $this->morphTo();
    }

    public function billPayments(){
        return $this->hasMany(BillPayment::class);
    }

    public function fee(){
        return $this->belongsTo(Fee::class);
    }

    public function semester(){
        return $this->belongsTo(Semester::class);
    }

    public function amountLeft() : Attribute {
        $amount_left = $this->amount-$this->amount_paid;
        if ($amount_left < 0) $amount_left = 0;
        return new Attribute(
            get: fn() => $amount_left,
        );
    }

}
