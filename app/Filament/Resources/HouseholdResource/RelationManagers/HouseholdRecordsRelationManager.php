<?php

namespace App\Filament\Resources\HouseholdResource\RelationManagers;

use App\Models\BarangayRecord;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HouseholdRecordsRelationManager extends RelationManager
{
    protected static string $relationship = 'records';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('barangay_record_id')
                    ->options(BarangayRecord::all()->pluck('short_and_long_name','id'))
                    ->searchable(),
                
                Forms\Components\TextInput::make('number')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('number')
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('Record #'),
                    
                Tables\Columns\TextColumn::make('barangayRecord.short_and_long_name')
                    ->label('Barangay'),

                Tables\Columns\TextColumn::make('number')
                    ->label('Household number'),
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
