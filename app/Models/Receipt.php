<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Receipt extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_id',
        'number',
        'fee_amount',
        'stamp_tax_amount',
        'date_issued',
        'receiptable_id',
        'receiptable_type',
    ];

    public function request()
    {
        return $this->belongsTo(Request::class);
    }

    public function receiptable() : MorphTo {
        return $this->morphTo();
    }
}
