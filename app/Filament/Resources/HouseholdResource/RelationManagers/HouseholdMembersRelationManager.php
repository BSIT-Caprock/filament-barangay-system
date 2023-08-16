<?php

namespace App\Filament\Resources\HouseholdResource\RelationManagers;

use App\Filament\Resources\ResidentResource;
use App\Models\Resident;
use App\Models\ResidentKey;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HouseholdMembersRelationManager extends RelationManager
{
    protected static string $relationship = 'household_members';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
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
            ->modelLabel('Household member')
            // ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('id'),

                Tables\Columns\TextColumn::make('record_key.id'),

                Tables\Columns\TextColumn::make('last_name')
                ->searchable(),
            
                Tables\Columns\TextColumn::make('first_name')
                ->searchable(),
            
                Tables\Columns\TextColumn::make('birth_date'),

            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->slideOver(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                    ->slideOver()
                    ->mutateFormDataUsing(function (array $data): array {
                        $key = new ResidentKey();
                        $key->save();
                        $data['key_id'] = $key->id;
                        return $data;
                    })
            ]);
    }
}
