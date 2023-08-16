<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseholdRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'household_id',
        'barangay_record_id',
        'number',
    ];

    public function household()
    {
        return $this->belongsTo(Household::class);
    }

    public function barangayRecord()
    {
        return $this->belongsTo(BarangayRecord::class);
    }

    public function residentRecords()
    {
        return $this->hasMany(ResidentRecord::class);
    }
}
