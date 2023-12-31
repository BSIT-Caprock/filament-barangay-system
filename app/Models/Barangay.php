<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Barangay extends Model
{
    use HasFactory;
    //use SoftDeletes;

    public function getRegionAttribute() 
    {
        return $this->region_code . ' - ' . $this->region_name;
    }

    public function records()
    {
        return $this->hasMany(BarangayRecord::class);
    }

    public function latestRecord() 
    {
        return $this->records()->one()->ofMany();
    }


    /**
     * search columns
     *
     * $columns are in ['column1' => where|orWhere, 'column2' => where|orWhere,..]
     **/    
    public function searchRecords(Builder $query, array $columns, string $search) 
    {
        return $query
        ->whereHas('records', function (Builder $query) use ($columns, $search) {
            foreach ($columns as $column => $whereType) {
                if ($whereType == 'where') {
                    $query->where($column, 'LIKE', "%{$search}%");
                } elseif ($whereType == 'orWhere') {
                    $query->orWhere($column, 'LIKE', "%{$search}%");
                }
                
            }
        });
    }
}
