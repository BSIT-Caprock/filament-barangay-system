<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ResidentResource\Pages;
use App\Filament\Resources\ResidentResource\RelationManagers;
use App\Models\Household;
use App\Models\Residence;
use App\Models\Resident;
use App\Models\ResidentKey;
use App\Models\ResidentRecord;
use Filament\Actions\CreateAction;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ResidentResource extends Resource
{
    protected static ?string $model = Resident::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function getFC($key)
    {
        $components = [
            'household_id' => Forms\Components\Select::make('household_id')
                ->label('Household')
                ->options(Household::all()->pluck('number', 'id'))
                ->searchable()
                ->required(),
            
            'last_name' => Forms\Components\TextInput::make('last_name')
                ->required(),

            'first_name' => Forms\Components\TextInput::make('first_name')
                ->required(),

            'middle_name' => Forms\Components\TextInput::make('middle_name'),

            'name_extension' => Forms\Components\TextInput::make('name_extension')
                ->label('Extension name'),

            'birth_place' => Forms\Components\TextInput::make('birth_place')
                ->label('Place of birth'),

            'birth_date' => Forms\Components\DatePicker::make('birth_date')
                ->label('Date of birth'),

            'sex' => Forms\Components\Select::make('sex')
                ->label('Sex / Gender')
                ->options([
                    'F' => 'Female',
                    'M' => 'Male',
                ])
                ->required(),

            'civil_status' => Forms\Components\Select::make('civil_status')
                ->options([
                    'S' => 'Single',
                    'M' => 'Married',
                    'W' => 'Widow / Widower',
                    'SE' => 'Separated',
                ])
                ->required(),

            'citizenship' => Forms\Components\TextInput::make('citizenship')
                ->required(),

            'occupation' => Forms\Components\TextInput::make('occupation')
                ->label('Profession / occupation'),

            'house_number' => Forms\Components\TextInput::make('house_number'),

            'street_name' => Forms\Components\TextInput::make('street_name')
                ->required(),

            'area_name' => Forms\Components\TextInput::make('area_name')
                ->label('Name of subdivision / zone / sitio / purok (if applicable)'),

        ];

        return $components[$key];
    }

    public static function getTC($key, $prefix = null)
    {
        $components = [
            'id' => Tables\Columns\TextColumn::make($prefix .  'id'),

            'key_id' => Tables\Columns\TextColumn::make($prefix . 'key_id'),

            'household_id' => Tables\Columns\TextColumn::make($prefix . 'last_name'),

            'last_name' => Tables\Columns\TextColumn::make($prefix . 'last_name'),

            'first_name' => Tables\Columns\TextColumn::make($prefix . 'first_name'),

            'middle_name' => Tables\Columns\TextColumn::make($prefix . 'middle_name'),

            'name_extension' => Tables\Columns\TextColumn::make($prefix . 'name_extension')
                ->label('Extension name'),

            'birth_place' => Tables\Columns\TextColumn::make($prefix . 'birth_place')
                ->label('Place of birth'),

            'birth_date' => Tables\Columns\TextColumn::make($prefix . 'birth_date')
                ->label('Date of birth'),

            'sex' => Tables\Columns\TextColumn::make($prefix . 'sex')
                ->label('Gender / sex'),

            'civil_status' => Tables\Columns\TextColumn::make($prefix . 'civil_status'),

            'citizenship' => Tables\Columns\TextColumn::make($prefix . 'citizenship'),

            'occupation' => Tables\Columns\TextColumn::make($prefix . 'occupation')
                ->label('Profession / occupation'),

            'house_number' => Tables\Columns\TextColumn::make($prefix . 'house_number'),

            'street_name' => Tables\Columns\TextColumn::make($prefix . 'street_name'),

            'area_name' => Tables\Columns\TextColumn::make($prefix . 'area_name')
                ->label('Name of subdivision / zone / sitio / purok (if applicable)'),
        ];

        return $components[$key];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                self::getFC('household_id')->hiddenOn('edit'),
                
                self::getFC('last_name')->hiddenOn('edit'),
                
                self::getFC('first_name')->hiddenOn('edit'),
                
                self::getFC('middle_name')->hiddenOn('edit'),
                
                self::getFC('name_extension')->hiddenOn('edit'),
                
                self::getFC('birth_place')->hiddenOn('edit'),
                
                self::getFC('birth_date')->hiddenOn('edit'),
                
                self::getFC('sex')->hiddenOn('edit'),
                
                self::getFC('civil_status')->hiddenOn('edit'),
                
                self::getFC('citizenship')->hiddenOn('edit'),
                
                self::getFC('occupation')->hiddenOn('edit'),
                
                self::getFC('house_number')->hiddenOn('edit'),
                
                self::getFC('street_name')->hiddenOn('edit'),
                
                self::getFC('area_name')->hiddenOn('edit'),

            ]);
    }

    public static function table(Table $table): Table
    {
        $prefix = '';
        return $table
            ->modifyQueryUsing(fn (Builder $query) => $query->mostCurrent())
            ->columns([
                self::getTC('id', $prefix),

                self::getTC('key_id', $prefix),
                
                self::getTC('last_name', $prefix),
                
                self::getTC('first_name', $prefix),
                
                self::getTC('birth_date', $prefix),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('sex')
                    ->label('gender / sex')
                    // ->query(function (Builder $query) {
                    //     return Resident::withoutGlobalScopes();
                    // })
                    ->options([
                        'F' => 'Female',
                        'M' => 'Male',
                    ]),
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
            RelationManagers\RecordHistoryRelationManager::class,
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
