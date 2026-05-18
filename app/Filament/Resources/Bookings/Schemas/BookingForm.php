<?php

namespace App\Filament\Resources\Bookings\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BookingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('guest_id')
                    ->required()
                    ->numeric(),
                TextInput::make('villa_id')
                    ->required()
                    ->numeric(),
                DateTimePicker::make('tanggal_checkin')
                    ->required(),
                DateTimePicker::make('tanggal_checkout')
                    ->required(),
                TextInput::make('status')
                    ->required(),
                TextInput::make('catatan'),
                TextInput::make('jumlah_tamu')
                    ->required()
                    ->numeric(),
                TextInput::make('total_harga')
                    ->required()
                    ->numeric(),
            ]);
    }
}
