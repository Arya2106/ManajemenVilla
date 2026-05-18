<?php

namespace App\Filament\Resources\Bookings\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class BookingInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('guest_id')
                    ->numeric(),
                TextEntry::make('villa_id')
                    ->numeric(),
                TextEntry::make('tanggal_checkin')
                    ->dateTime(),
                TextEntry::make('tanggal_checkout')
                    ->dateTime(),
                TextEntry::make('status'),
                TextEntry::make('catatan')
                    ->placeholder('-'),
                TextEntry::make('jumlah_tamu')
                    ->numeric(),
                TextEntry::make('total_harga')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
