<?php

namespace App\Filament\Resources\Villas\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class VillaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama')
                    ->required(),
                TextInput::make('kapasitas')
                    ->required()
                    ->numeric(),
                TextInput::make('jumlah_kamar')
                    ->required()
                    ->numeric(),
                TextInput::make('harga_permalam')
                    ->required()
                    ->numeric(),
                TextInput::make('status')
                    ->required(),
                TextInput::make('keterangan'),
            ]);
    }
}
