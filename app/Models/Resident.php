<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    use HasFactory;

    protected $fillable = [
        'key_id',
        'household_id',
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
        'house_number',
        'street_name',
        'area_name',
    ];

    public function record_key() 
    {
        return $this->belongsTo(ResidentKey::class, 'key_id');
    }

    public function record_history()
    {
        return $this->hasMany(self::class, 'key_id', 'key_id');
    }

    public function latest_record() 
    {
        return $this->record_history()->one()->ofMany();
    }

    public function scopeMostCurrent(Builder $query)
    {
        $latest = ResidentKey::with('latest_record')->get()->pluck('latest_record.id');
        return $query->whereIn('id', $latest);
    }

    public function household()
    {
        return $this->belongsTo(Household::class);
    }
}
