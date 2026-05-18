<?php

namespace App\Filament\Resources\Payments\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PaymentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('booking_id')
                    ->required()
                    ->numeric(),
                DateTimePicker::make('tanggal_pembayaran')
                    ->required(),
                TextInput::make('metode_pembayaran')
                    ->required(),
                TextInput::make('total_pembayaran')
                    ->required()
                    ->numeric(),
                TextInput::make('status')
                    ->required(),
            ]);
    }
}
