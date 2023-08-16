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
                Forms\Components\TextInput::make('last_name')
                    ->required(),
                
                Forms\Components\TextInput::make('first_name')
                    ->required(),
                
                Forms\Components\TextInput::make('middle_name'),
                
                Forms\Components\TextInput::make('name_extension')
                    ->label('Extension name'),
                
                Forms\Components\TextInput::make('birth_place')
                    ->label('Place of birth'),
                
                Forms\Components\DatePicker::make('birth_date')
                    ->label('Date of birth'),
                
                Forms\Components\Select::make('sex')
                    ->label('Sex / Gender')
                    ->options([
                        'F' => 'Female',
                        'M' => 'Male',
                    ])
                    ->required(),
                
                Forms\Components\Select::make('civil_status')
                    ->label('Civil status')
                    ->options([
                        'S' => 'Single',
                        'M' => 'Married',
                        'W' => 'Widow / Widower',
                        'SE' => 'Separated',
                    ])
                    ->required(),
                
                Forms\Components\TextInput::make('citizenship')
                    ->required(),
                
                Forms\Components\TextInput::make('occupation')
                    ->label('Profession / occupation'),
                
                Forms\Components\TextInput::make('house_number'),
                
                Forms\Components\TextInput::make('street_name')
                    ->required(),
                
                Forms\Components\TextInput::make('area_name')
                    ->label('Name of subdivision / zone / sitio / purok (if applicable)'),

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
