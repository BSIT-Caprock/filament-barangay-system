<?php

namespace App\Filament\Resources\ResidentResource\Pages;

use App\Filament\Resources\ResidentResource;
use App\Models\Resident;
use App\Models\ResidentKey;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateResident extends CreateRecord
{
    protected static string $resource = ResidentResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $key = new ResidentKey();
        $key->save();
        $resident = new Resident($data);
        $resident->record_key()->associate($key);
        $resident->save();
        return $resident;
    }
}
