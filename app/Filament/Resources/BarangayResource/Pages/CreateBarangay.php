<?php

namespace App\Filament\Resources\BarangayResource\Pages;

use App\Filament\Resources\BarangayResource;
use App\Models\Barangay;
use App\Models\BarangayKey;
use App\Models\BarangayRecord;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateBarangay extends CreateRecord
{
    protected static string $resource = BarangayResource::class;

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'New barangay added';
    }

    protected function handleRecordCreation(array $data): Model 
    {
        $key = new BarangayKey();
        $key->save();
        $barangay = new Barangay($data);
        $barangay->record_key()->associate($key);
        $barangay->save();
        return $barangay;
    }
}
