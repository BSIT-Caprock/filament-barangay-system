<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Barangay extends Model
{
    use HasFactory;

    protected $fillable = [
        'key_id',
        'region_code',
        'region_name',
        'province',
        'city_or_municipality',
        'short_name',
        'long_name',
    ];

    public function record_key() 
    {
        return $this->belongsTo(BarangayKey::class, 'key_id');
    }

    public function record_history()
    {
        return $this->hasMany(self::class, 'key_id', 'key_id');
    }

    public function households()
    {
        return $this->hasMany(Household::class);
    }

    //use SoftDeletes;

    // public function getRegionAttribute() 
    // {
    //     return $this->region_code . ' - ' . $this->region_name;
    // }

    // public function records()
    // {
    //     return $this->hasMany(BarangayRecord::class);
    // }

    // public function latestRecord() 
    // {
    //     return $this->records()->one()->ofMany();
    // }


    /**
     * search columns
     *
     * $columns are in ['column1' => where|orWhere, 'column2' => where|orWhere,..]
     **/    
    // public function searchRecords(Builder $query, array $columns, string $search) 
    // {
    //     return $query
    //     ->whereHas('records', function (Builder $query) use ($columns, $search) {
    //         foreach ($columns as $column => $whereType) {
    //             if ($whereType == 'where') {
    //                 $query->where($column, 'LIKE', "%{$search}%");
    //             } elseif ($whereType == 'orWhere') {
    //                 $query->orWhere($column, 'LIKE', "%{$search}%");
    //             }
                
    //         }
    //     });
    // }
}
