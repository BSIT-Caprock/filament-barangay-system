<?php

namespace App\Filament\Resources\BarangayResource\Pages;

use App\Filament\Resources\BarangayResource;
use App\Models\BarangayKey;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBarangays extends ListRecords
{
    protected static string $resource = BarangayResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('delete_unused_keys')
                ->color('danger')
                ->requiresConfirmation()
                ->action(function () {
                    $unused = BarangayKey::has('records', '=', 0);
                    $unused->delete();
                }),
        ];
    }
}
