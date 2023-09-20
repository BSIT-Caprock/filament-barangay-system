<?php

namespace App\Filament\Resources\BarangayResource\Pages;

use App\Filament\Resources\BarangayResource;
use App\Models\Barangay;
use App\Models\BarangayRecord;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateBarangay extends CreateRecord
{
    protected static string $resource = BarangayResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'New barangay added';
    }

    protected function handleRecordCreation(array $data): Model 
    {
    //     $barangayKey = new BarangayKey();
    //     $barangayKey->save();
    //     return static::getModel()::create([
    //         'barangay_key_id'      => $barangayKey->id,
    //         'region_code'          => $data['region_code'],
    //         'region_name'          => $data['region_name'],
    //         'province'             => $data['province'],
    //         'city_or_municipality' => $data['city_or_municipality'],
    //         'code'                 => $data['code'],
    //         'name'                 => $data['name'],
    //     ]);
        # TODO: use transactions
        # 1. create barangay
        $barangay = new Barangay();
        $barangay->save();
        # 2. create barangay record
        $barangay->records()->create($data);
        # 3. return new barangay
        return $barangay;
    }
}
