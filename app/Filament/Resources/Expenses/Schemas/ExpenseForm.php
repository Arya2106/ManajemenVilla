<?php

namespace App\Filament\Resources\Expenses\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ExpenseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('kategori')
                    ->required(),
                TextInput::make('keterangan'),
                TextInput::make('nominal')
                    ->required()
                    ->numeric(),
                DateTimePicker::make('tanggal_pengeluaran')
                    ->required(),
            ]);
    }
}
