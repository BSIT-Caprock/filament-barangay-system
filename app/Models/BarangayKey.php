<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangayKey extends Model
{
    use HasFactory;

    public function records()
    {
        return $this->hasMany(Barangay::class, 'key_id');
    }

    public function latestRecord() 
    {
        return $this->record_history()->one()->ofMany();
    }

    public function scopeUnused(Builder $query)
    {
        return $query->has('records', '=', 0);
    }
}
