<?php

namespace App\Filament\Resources;

use Date;
use Carbon\Carbon;
use App\Models\Room;
use Filament\Tables;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Transaction;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use App\Filament\Resources\TransactionResource\Pages;

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
                    ->default(function () {
                        return 'KOS' . strval(random_int(1000, 100000000));
                    })
                    ->readOnly()
                    ->required(),
                DatePicker::make('transaction_date')
                    ->default(function () {
                        return Carbon::today();
                    })
                    ->required(),
                Select::make('boarding_house_id')
                    ->relationship('boardingHouse', 'name'),
                Select::make('room_id')
                    ->relationship('room', 'name'),
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->email()
                    ->required(),
                TextInput::make('phone_number')
                    ->startsWith('62')
                    ->default(function () {
                        return '62';
                    })
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
                    ->default(function () {
                        return Carbon::today();
                    })
                    ->required(),
                TextInput::make('duration')
                    ->prefix('Month')
                    ->numeric()
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set, Get $get) {
                        $room = Room::find($get('room_id'));
                        if ($room) {
                            $duration = $state;
                            $subTotal = $room->price_per_month * $duration;
                            $ppn = $subTotal * 0.11;
                            $insurance = $subTotal * 0.01;
                            $total_amount = $subTotal + $ppn + $insurance;
                            $set('total_amount', $total_amount);
                        }
                    }),
                TextInput::make('total_amount')
                    ->prefix('IDR')
                    ->numeric()
                    ->readOnly()
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')
                    ->searchable(),
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
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }
}
