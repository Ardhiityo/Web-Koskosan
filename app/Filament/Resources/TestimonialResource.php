<?php

namespace App\Filament\Resources;

use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Testimonial;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use App\Filament\Resources\TestimonialResource\Pages;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;
    protected static ?string $navigationGroup = 'Boarding House Management';
    protected static ?string $navigationIcon = 'heroicon-o-star';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required(),
                FileUpload::make('photo')
                    ->image()
                    ->directory('testimonials')
                    ->required()
                    ->columnSpan(2),
                Select::make('boarding_house_id')
                    ->relationship('boardingHouse', 'name')
                    ->required(),
                Textarea::make('content')
                    ->required(),
                TextInput::make('rating')
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(5)
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                ImageColumn::make('photo')
                    ->circular(),
                TextColumn::make('boardingHouse.name'),
                TextColumn::make('rating')
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
            'index' => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'edit' => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }
}
