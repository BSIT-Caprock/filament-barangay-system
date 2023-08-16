<?php

namespace App\Filament\Resources\ResidentResource\Pages;

use App\Filament\Resources\ResidentResource;
use App\Models\ResidentKey;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListResidents extends ListRecords
{
    protected static string $resource = ResidentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('delete_unused_keys')
            ->color('danger')
            ->requiresConfirmation()
            ->action(function () {
                $unused = ResidentKey::has('records', '=', 0);
                $unused->delete();
            }),
        ];
    }
}
