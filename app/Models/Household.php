<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Household extends Model
{
    use HasFactory;
    
    public function records()
    {
        return $this->hasMany(HouseholdRecord::class);
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
