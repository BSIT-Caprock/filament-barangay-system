<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResidentRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'resident_id',
        'household_record_id',
        'last_name',
        'first_name',
        'middle_name',
        'name_extension',
        'birth_place',
        'birth_date',
        'sex',
        'civil_status',
        'citizenship',
        'occupation',
        'residence_id',
    ];

    public function householdRecord()
    {
        return $this->belongsTo(HouseholdRecord::class);
    }

    public function getLastNameAndFirstNameAttribute()
    {
        return $this->last_name . ', '. $this->first_name;
    }

    public function residence()
    {
        return $this->belongsTo(Residence::class);
    }
}
