<?php

namespace App\Filament\Resources\HouseholdResource\Pages;

use App\Filament\Resources\HouseholdResource;
use App\Models\HouseholdKey;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHouseholds extends ListRecords
{
    protected static string $resource = HouseholdResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('delete_unused_keys')
                ->color('danger')
                ->requiresConfirmation()
                ->action(function () {
                    HouseholdKey::unused()->delete();
                }),
        ];
    }
}
