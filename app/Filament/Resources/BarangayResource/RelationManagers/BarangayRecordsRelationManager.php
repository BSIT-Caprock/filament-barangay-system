<?php

namespace App\Filament\Resources\BarangayResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BarangayRecordsRelationManager extends RelationManager
{
    protected static string $relationship = 'records';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('region_code')
                    ->required()
                    ->maxLength(255),
                
                Forms\Components\TextInput::make('region_name')
                    ->required()
                    ->maxLength(255),
                
                Forms\Components\TextInput::make('province')
                    ->required()
                    ->maxLength(255),
                
                Forms\Components\TextInput::make('city_or_municipality')
                    ->required()
                    ->maxLength(255),
                
                Forms\Components\TextInput::make('short_name')
                    ->required()
                    ->maxLength(255),
                
                Forms\Components\TextInput::make('long_name')
                    ->required()
                    ->maxLength(255),
                
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('long_name')
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('#'),
                
                Tables\Columns\TextColumn::make('region_code')
                ->label('Region code'),
            
                Tables\Columns\TextColumn::make('region_name')
                    ->label('Region name'),

                Tables\Columns\TextColumn::make('province')
                    ->label('Province'),

                Tables\Columns\TextColumn::make('city_or_municipality')
                    ->label('City / Municipality'),

                Tables\Columns\TextColumn::make('short_name')
                    ->label('Abbreviation / Short name'),

                Tables\Columns\TextColumn::make('long_name')
                    ->label('Name of barangay'),
            ])
            ->filters([
                //Tables\Filters\TrashedFilter::make()
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                //Tables\Actions\ForceDeleteAction::make(),
                //Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    //Tables\Actions\RestoreBulkAction::make(),
                    //Tables\Actions\ForceDeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ])
            // ->modifyQueryUsing(fn (Builder $query) => $query->withoutGlobalScopes([
            //     SoftDeletingScope::class,
            // ]))
            ;
    }
}
