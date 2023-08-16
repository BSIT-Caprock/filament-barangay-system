<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseholdKey extends Model
{
    use HasFactory;

    public function records()
    {
        return $this->hasMany(Household::class, 'key_id');
    }
}
