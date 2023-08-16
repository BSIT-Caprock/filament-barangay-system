<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Household extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'key_id',
        'barangay_id',
        'number',
    ];

    public function record_key() 
    {
        return $this->belongsTo(HouseholdKey::class, 'key_id');
    }

    public function record_history()
    {
        return $this->hasMany(self::class, 'key_id', 'key_id');
    }

    public function barangay()
    {
        return $this->belongsTo(Barangay::class);
    }

    public function residents()
    {
        return $this->hasMany(Resident::class);
    }
}
