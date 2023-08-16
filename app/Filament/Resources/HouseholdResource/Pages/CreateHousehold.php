<?php

namespace App\Filament\Resources\HouseholdResource\Pages;

use App\Filament\Resources\HouseholdResource;
use App\Models\Household;
use App\Models\HouseholdKey;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateHousehold extends CreateRecord
{
    protected static string $resource = HouseholdResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $key = new HouseholdKey();
        $key->save();
        $household = new Household($data);
        $household->record_key()->associate($key);
        $household->save();
        return $household;
    }
}
