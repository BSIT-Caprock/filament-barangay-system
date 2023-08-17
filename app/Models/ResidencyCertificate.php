<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class ResidencyCertificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'resident_id',
    ];

    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }

    public function receipt() : MorphOne
    {
        return $this->morphOne(Receipt::class, 'receiptable');
    }
}
