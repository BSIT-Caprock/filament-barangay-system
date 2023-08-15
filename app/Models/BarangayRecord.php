<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BarangayRecord extends Model
{
    use HasFactory;
    //use SoftDeletes;

    protected $fillable = [
        'barangay_id',
        'region_code',
        'region_name',
        'province',
        'city_or_municipality',
        'short_name',
        'long_name',
    ];

    public function barangay() 
    {
        return $this->belongsTo(Barangay::class);
    }

    public function households() {
        return $this->hasMany(HouseholdRecord::class);
    }

    public function getRegionAttribute() 
    {
        return $this->region_code . ' - ' . $this->region_name;
    }

    public function getShortAndLongNameAttribute()
    {
        return $this->short_name . ' / ' . $this->long_name;
    }
}

