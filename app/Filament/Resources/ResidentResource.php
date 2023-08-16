<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ResidentResource\Pages;
use App\Filament\Resources\ResidentResource\RelationManagers;
use App\Models\Household;
use App\Models\HouseholdRecord;
use App\Models\Residence;
use App\Models\Resident;
use App\Models\ResidentRecord;
use Filament\Actions\CreateAction;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ResidentResource extends Resource
{
    protected static ?string $model = Resident::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('household_id')
                    ->label('Household')
                    ->options(Household::all()->pluck('number', 'id'))
                    ->searchable()
                    ->required(),
                
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

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),

                Tables\Columns\TextColumn::make('key_id'),
                
                Tables\Columns\TextColumn::make('last_name')
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('first_name')
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('birth_date'),
                
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListResidents::route('/'),
            'create' => Pages\CreateResident::route('/create'),
            'edit' => Pages\EditResident::route('/{record}/edit'),
        ];
    }    
}
