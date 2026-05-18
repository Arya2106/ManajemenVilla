<?php

namespace App\Filament\Resources\VillaPhotos\Pages;

use App\Filament\Resources\VillaPhotos\VillaPhotoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListVillaPhotos extends ListRecords
{
    protected static string $resource = VillaPhotoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
