<?php

namespace App\Filament\Resources\Villas\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class VillaInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('nama'),
                TextEntry::make('kapasitas')
                    ->numeric(),
                TextEntry::make('jumlah_kamar')
                    ->numeric(),
                TextEntry::make('harga_permalam')
                    ->numeric(),
                TextEntry::make('status'),
                TextEntry::make('keterangan')
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
