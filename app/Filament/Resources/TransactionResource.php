<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionResource\Pages;
use App\Models\Transaction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;
    protected static ?string $navigationGroup = 'Boarding House Management';
    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('code')
                    ->numeric()
                    ->required(),
                DatePicker::make('transaction_date')
                    ->required(),
                Select::make('boarding_house_id')
                    ->relationship('boardingHouse', 'name'),
                Select::make('room_id')
                    ->relationship('room', 'name'),
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->required(),
                TextInput::make('phone_number')
                    ->numeric()
                    ->required(),
                Select::make('payment_method')
                    ->options([
                        'down_payment' => 'Down payment',
                        'full_payment' => 'Full payment',
                    ])
                    ->required(),
                Select::make('payment_status')
                    ->options([
                        'pending' => 'Pending',
                        'paid' => 'Paid'
                    ])
                    ->required(),
                DatePicker::make('start_date')
                    ->required(),
                TextInput::make('duration')
                    ->prefix('Month')
                    ->numeric()
                    ->required(),
                TextInput::make('total_amount')
                    ->prefix('IDR')
                    ->numeric()
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code'),
                TextColumn::make('name'),
                TextColumn::make('payment_method'),
                TextColumn::make('payment_status'),
                TextColumn::make('total_amount')
                    ->prefix('IDR '),
                TextColumn::make('transaction_date')
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
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }
}
