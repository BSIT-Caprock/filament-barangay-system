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

                // TODO: limit options to barangay session
                Forms\Components\Select::make('household_record_id')
                    ->label('Household')
                    ->required()
                    ->options(HouseholdRecord::all()->pluck('number', 'id'))
                    ->searchable()
                    ->visibleOn('create'),
                
                Forms\Components\TextInput::make('last_name')
                    ->required()
                    ->visibleOn('create'),
                
                Forms\Components\TextInput::make('first_name')
                    ->required()
                    ->visibleOn('create'),
                
                Forms\Components\TextInput::make('middle_name')
                    ->required()
                    ->visibleOn('create'),
                
                Forms\Components\TextInput::make('name_extension')
                    ->required()
                    ->visibleOn('create'),
                
                Forms\Components\TextInput::make('birth_place')
                    ->label('Place of birth')
                    ->required()
                    ->visibleOn('create'),
                
                Forms\Components\DatePicker::make('birth_date')
                    ->label('Date of birth')
                    ->required()
                    ->visibleOn('create'),
                
                Forms\Components\Select::make('sex')
                    ->label('Sex / Gender')
                    ->required()
                    ->options([
                        'F' => 'Female',
                        'M' => 'Male',
                    ])
                    ->visibleOn('create'),
                
                Forms\Components\Select::make('civil_status')
                    ->label('Civil status')
                    ->required()
                    ->options([
                        'S' => 'Single',
                        'M' => 'Married',
                        'W' => 'Widow / Widower',
                        'SE' => 'Separated',
                    ])
                    ->visibleOn('create'),
                
                Forms\Components\TextInput::make('citizenship')
                    ->required()
                    ->visibleOn('create'),
                
                Forms\Components\TextInput::make('occupation')
                    ->required()
                    ->visibleOn('create'),
                
                Forms\Components\Select::make('residence_id')
                    ->required()
                    ->model(ResidentRecord::class)
                    ->relationship('residence', 'fullAddress')
                    ->searchable()
                    ->preload()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('house_number')
                        ->required(),
                        
                        Forms\Components\TextInput::make('street_name')
                        ->required(),
                        
                        Forms\Components\TextInput::make('area_name')
                        ->label('Name of subdivision / zone / sitio / purok'),
                        
                    ])
                    // ->createOptionUsing(function ($data) {
                    //     $residence = new Residence($data);
                    //     return $residence->id;
                    // })
                    // ->options(Residence::all()->pluck('fullAddress', 'id'))
                    ->visibleOn('create'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                
                Tables\Columns\TextColumn::make('latestRecord.id')
                    ->label('Record #'),
                
                Tables\Columns\TextColumn::make('latestRecord.lastNameAndFirstName')
                    ->label('Name'),
                
                Tables\Columns\TextColumn::make('latestRecord.birth_date')
                    ->label('Birth date'),
                
                Tables\Columns\TextColumn::make('latestRecord.residence.fullAddress')
                    ->label('Address'),
                
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
