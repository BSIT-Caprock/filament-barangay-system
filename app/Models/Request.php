<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'barangay_id',
        'last_name',
        'first_name',
        'middle_name_or_initial',
        'sex',
        'address',
        'age',
        'civil_status',
        'residency_certificate',
        'indigency_certificate',
        'message',
    ];

    public function barangay()
    {
        return $this->belongsTo(Barangay::class);
    }

    public function document_receipts()
    {
        return $this->hasMany(Receipt::class);
    }
}
