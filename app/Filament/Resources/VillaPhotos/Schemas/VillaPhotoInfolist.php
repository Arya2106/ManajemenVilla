<?php

namespace App\Filament\Resources\VillaPhotos\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class VillaPhotoInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
               TextEntry::make('villa.nama')
    ->label('villa'),
                TextEntry::make('keterangan')
                    ->placeholder('-'),
                ImageEntry::make('foto')
                ->disk('public'),
                IconEntry::make('status')
                    ->boolean(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
