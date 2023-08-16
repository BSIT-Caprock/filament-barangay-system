<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    use HasFactory;

    public function records()
    {
        return $this->hasMany(ResidentRecord::class);
    }

    public function latestRecord() 
    {
        return $this->records()->one()->ofMany();
    }

    public function residence()
    {
        return $this->belongsTo(Residence::class);
    }
}
