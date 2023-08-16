<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Residence extends Model
{
    use HasFactory;

    protected $fillable = [
        'house_number',
        'street_name',
        'area_name',
    ];

    public function getFullAddressAttribute()
    {
        return $this->house_number . ', ' . $this->street_name . ', ' . $this->area_name;
    }

    public function residentRecords()
    {
        return $this->hasMany(ResidentRecord::class);
    }

    public function residents()
    {
        return $this->hasManyThrough(Household::class, ResidentRecord::class);
    }
}
