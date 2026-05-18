<?php

namespace App\Filament\Resources\VillaPhotos\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class VillaPhotoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('villa_id')
                    ->relationship('villa', 'nama')
                    ->required(),
                TextInput::make('keterangan'),
                FileUpload::make('foto')
                    ->image()
                    ->directory('villa_photos')
                    ->disk('public')
                    ->visibility('public')
                    ->required(),
                Toggle::make('status')
                    ->required(),
            ]);
    }
}
