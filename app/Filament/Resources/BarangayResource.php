<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BarangayResource\Pages;
use App\Filament\Resources\BarangayResource\RelationManagers;
use App\Models\Barangay;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BarangayResource extends Resource
{
    protected static ?string $model = Barangay::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-library';

    //protected static ?string $navigationLabel = 'Barangay History';

    //protected static ?string $navigationGroup = 'Barangay';

    public static function getFC($key)
    {
        $components = [
            'region_code' => Forms\Components\TextInput::make('region_code')
                ->required(),

            'region_name' => Forms\Components\TextInput::make('region_name')
                ->required(),

            'province' => Forms\Components\TextInput::make('province')
                ->required(),

            'city_or_municipality' => Forms\Components\TextInput::make('city_or_municipality')
                ->label('City / Municipality')
                ->required(),

            'short_name' => Forms\Components\TextInput::make('short_name')
                ->required(),

            'long_name' => Forms\Components\TextInput::make('long_name')
                ->required(),
        ];
        return $components[$key];
    }

    public static function getTC($key)
    {
        $components = [
            'id' => Tables\Columns\TextColumn::make('id'),

            'key_id' => Tables\Columns\TextColumn::make('key_id'),

            'region_code' => Tables\Columns\TextColumn::make('region_code')
                ->label('Region code'),

            'region_name' => Tables\Columns\TextColumn::make('region_name')
                ->label('Region name'),

            'province' => Tables\Columns\TextColumn::make('province'),

            'city_or_municipality' => Tables\Columns\TextColumn::make('city_or_municipality')
                ->label('City / Municipality'),

            'short_name' => Tables\Columns\TextColumn::make('short_name'),

            'long_name' => Tables\Columns\TextColumn::make('long_name')
                ->label('Name of barangay'),

        ];
        return $components[$key];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                self::getFC('region_code'),

                self::getFC('region_name'),

                self::getFC('province'),

                self::getFC('city_or_municipality'),

                self::getFC('short_name'),

                self::getFC('long_name'),

                // Forms\Components\Select::make('barangay_key_id')
                //     //->relationship('barangayKey', 'id')
                //     //->options(BarangayKey::all()->pluck('id'))
                //     ->getSearchResultsUsing(
                //         // fn (string $search) => 
                //             // Barangay::where('name', 'LIKE', "%{$search}%")
                //                 //->groupby('barangay_key_id')
                //                 // ->pluck('name', 'barangay_key_id')
                //         fn (string $search) =>
                //             BarangayKey::whereHas('barangays', function (Builder $query) use ($search) {
                //                 $query->where('name', 'LIKE', "%{$search}%");
                //             })->get()->pluck('latest_barangay', 'id')
                //     )
                //     ->getOptionLabelUsing(fn ($value): ?string => $value->name)
                //     ->searchable()
                //     ->preload()
                //     ->createOptionModalHeading('New')
                //     ->createOptionForm([
                //         Forms\Components\Placeholder::make('Information')
                //             ->content('This will make a new id.'),
                //     ])
                //     ->required(),

            //     Tables\Columns\TextColumn::make('id')
            //     ->label('Key'),

            // Tables\Columns\TextColumn::make('latest_barangay.region')
            //     ->label('Region')
            //     ->searchable(query: fn (Builder $query, string $search) 
            //         => BarangayKey::searchBarangay($query, [
            //             'region_code' => 'where', 
            //             'region_name' => 'orWhere'
            //         ], $search)),

            // Tables\Columns\TextColumn::make('latest_barangay.province')
            //     ->label('Province')
            //     ->searchable(query: fn (Builder $query, string $search) 
            //         => BarangayKey::searchBarangay($query, [
            //             'province' => 'where',
            //         ], $search)),

            // Tables\Columns\TextColumn::make('latest_barangay.city_or_municipality')
            //     ->label('City / Municipality')
            //     ->searchable(query: fn (Builder $query, string $search) 
            //         => BarangayKey::searchBarangay($query, [
            //             'city_or_municipality' => 'where',
            //         ], $search)),

            // Tables\Columns\TextColumn::make('latest_barangay.code')
            //     ->label('Codename / Label')
            //     ->searchable(query: fn (Builder $query, string $search) 
            //         => BarangayKey::searchBarangay($query, [
            //             'code' => 'where',
            //         ], $search)),

            // Tables\Columns\TextColumn::make('latest_barangay.name')
            //     ->label('Name of barangay')
            //     ->searchable(query: fn (Builder $query, string $search) 
            //         => BarangayKey::searchBarangay($query, [
            //             'name' => 'where',
            //         ], $search)),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Tables\Columns\TextColumn::make('region')
                //     ->getStateUsing(fn ($record) => $record->region_code . ' - ' . $record->region_name)
                //     ->searchable(['region_code', 'region_name']),
                self::getTC('id'),

                self::getTC('key_id'),

                self::getTC('region_code')
                    ->searchable(),
                
                self::getTC('region_name')
                    ->searchable(),

                self::getTC('province')
                    ->searchable(),

                self::getTC('city_or_municipality')
                    ->searchable(),

                self::getTC('short_name')
                    ->searchable(),

                self::getTC('long_name')
                    ->searchable(),

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
            //RelationManagers\BarangayRecordsRelationManager::class,
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBarangays::route('/'),
            'create' => Pages\CreateBarangay::route('/create'),
            'edit' => Pages\EditBarangay::route('/{record}/edit'),
        ];
    }    
}
