<?php

namespace App\Filament\Resources;

use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use App\Models\BoardingHouse;
use Filament\Resources\Resource;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use App\Filament\Resources\BoardingHouseResource\Pages;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;

class BoardingHouseResource extends Resource
{
    protected static ?string $model = BoardingHouse::class;
    protected static ?string $navigationGroup = 'Boarding House Management';
    protected static ?string $navigationIcon = 'heroicon-o-home-modern';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Tabs')
                    ->tabs([
                        Tab::make('General information')
                            ->schema([
                                TextInput::make('name')
                                    ->required()
                                    ->reactive()
                                    ->debounce(500)
                                    ->afterStateUpdated(function ($state, callable $set) {
                                        $set('slug', Str::slug($state));
                                    }),
                                TextInput::make('slug')
                                    ->required(),
                                FileUpload::make('thumbnail')
                                    ->image()
                                    ->directory('thumbnail')
                                    ->required(),
                                Select::make('city_id')
                                    ->relationship(name: 'city', titleAttribute: 'name')
                                    ->required(),
                                Select::make('category_id')
                                    ->relationship(name: 'category', titleAttribute: 'name')
                                    ->required(),
                                TextArea::make('description')
                                    ->required(),
                                Textarea::make('address')
                                    ->required(),
                            ]),
                        Tab::make('Bonus')
                            ->schema([
                                Repeater::make('bonuses')
                                    ->relationship()
                                    ->schema([
                                        TextInput::make('name')
                                            ->required(),
                                        TextInput::make('description')
                                            ->required(),
                                        FileUpload::make('image')
                                            ->image()
                                            ->directory('bonuses')
                                            ->required(),
                                    ])
                            ]),
                        Tab::make('Room')
                            ->schema([
                                Repeater::make('rooms')
                                    ->relationship()
                                    ->schema([
                                        TextInput::make('name')
                                            ->required(),
                                        TextInput::make('room_type')
                                            ->required(),
                                        TextInput::make('capacity')
                                            ->numeric()
                                            ->required(),
                                        TextInput::make('square_feet')
                                            ->required(),
                                        TextInput::make('price_per_month')
                                            ->numeric()
                                            ->required(),
                                        Toggle::make('is_available')
                                            ->required(),
                                        Repeater::make('roomImages')
                                            ->relationship()
                                            ->schema([
                                                FileUpload::make('image')
                                                    ->image()
                                                    ->directory('room-images')
                                                    ->required(),
                                            ])
                                    ]),
                            ]),
                    ])
                    ->columnSpan(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('city.name'),
                TextColumn::make('category.name'),
                ImageColumn::make('thumbnail')
                    ->circular(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListBoardingHouses::route('/'),
            'create' => Pages\CreateBoardingHouse::route('/create'),
            'edit' => Pages\EditBoardingHouse::route('/{record}/edit'),
        ];
    }
}
