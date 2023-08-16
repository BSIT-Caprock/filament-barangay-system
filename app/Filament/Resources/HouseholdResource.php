<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HouseholdResource\Pages;
use Filament\Resources\RelationManagers\RelationGroup;
use App\Filament\Resources\HouseholdResource\RelationManagers;
use App\Models\Barangay;
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

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('barangay_id')
                    ->label('Barangay')
                    ->options(Barangay::pluck('long_name', 'id'))
                    ->searchable()
                    ->required(),

                Forms\Components\TextInput::make('number')
                    ->label('Household number')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),

                Tables\Columns\TextColumn::make('barangay.long_name')
                    ->label('Barangay'),

                Tables\Columns\TextColumn::make('number')
                    ->label('Household no.'),

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
            RelationManagers\HouseholdMembersRelationManager::class,
            // RelationGroup::make('Household members', [
            //     RelationManagers\ResidentRecordsRelationManager::class,
            // ]),
            // RelationGroup::make('Details', [
            //     RelationManagers\HouseholdRecordsRelationManager::class,
            // ]),
            
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
