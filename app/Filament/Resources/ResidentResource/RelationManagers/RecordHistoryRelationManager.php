<?php

namespace App\Filament\Resources\ResidentResource\RelationManagers;

use App\Filament\Resources\ResidentResource;
use Filament\Forms;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RecordHistoryRelationManager extends RelationManager
{
    protected static string $relationship = 'record_history';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                ResidentResource::getFC('household_id'),
                
                ResidentResource::getFC('last_name'),
                
                ResidentResource::getFC('first_name'),
                
                ResidentResource::getFC('middle_name'),
                
                ResidentResource::getFC('name_extension'),
                
                ResidentResource::getFC('birth_place'),
                
                ResidentResource::getFC('birth_date'),
                
                ResidentResource::getFC('sex'),
                
                ResidentResource::getFC('civil_status'),
                
                ResidentResource::getFC('citizenship'),
                
                ResidentResource::getFC('occupation'),
                
                ResidentResource::getFC('house_number'),
                
                ResidentResource::getFC('street_name'),
                
                ResidentResource::getFC('area_name'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            //->recordTitleAttribute('id')
            ->modelLabel('record')
            ->columns([
                ResidentResource::getTC('id'),

                ResidentResource::getTC('key_id'),
                
                ResidentResource::getTC('last_name'),
                
                ResidentResource::getTC('first_name'),
                
                ResidentResource::getTC('birth_date'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }
}
