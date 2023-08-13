<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barangay extends Model
{
    use HasFactory;

    public function getRegionAttribute() {
        return $this->region_code . ' - ' . $this->region_name;
    }
}
