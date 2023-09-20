<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HouseholdResource\Pages;
use Filament\Resources\RelationManagers\RelationGroup;
use App\Filament\Resources\HouseholdResource\RelationManagers;
use App\Models\BarangayRecord;
use App\Models\Household;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HouseholdResource extends Resource
{
    protected static ?string $model = Household::class;

    protected static ?string $navigationIcon = 'heroicon-o-home-modern';

    protected static ?string $activeNavigationIcon = 'heroicon-m-home-modern';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('barangay_record_id')
                    ->required()
                    ->options(BarangayRecord::all()->pluck('short_and_long_name','id'))
                    ->searchable()
                    ->visibleOn('create'),

                Forms\Components\TextInput::make('number')
                    ->required()
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
                
                Tables\Columns\TextColumn::make('latestRecord.number')
                    ->label('Household number'),
                
                Tables\Columns\TextColumn::make('latestRecord.barangayRecord.short_and_long_name')
                    ->label('Barangay'),

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
            RelationGroup::make('Household members', [
                RelationManagers\ResidentRecordsRelationManager::class,
            ]),
            RelationGroup::make('Details', [
                RelationManagers\HouseholdRecordsRelationManager::class,
            ]),
            
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHouseholds::route('/'),
            'create' => Pages\CreateHousehold::route('/create'),
            'edit' => Pages\EditHousehold::route('/{record}/edit'),
        ];
    }    

    public static function getFormSchema(string $section = null): array
    {
        return [
            Forms\Components\Select::make('barangay_record_id')
                ->required()
                ->options(BarangayRecord::all()->pluck('short_and_long_name','id'))
                ->searchable()
                ->visibleOn('create'),

            Forms\Components\TextInput::make('number')
                ->required()
                ->visibleOn('create'),
        ];
    }
}
