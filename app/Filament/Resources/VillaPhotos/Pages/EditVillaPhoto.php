<?php

namespace App\Filament\Resources\VillaPhotos\Pages;

use App\Filament\Resources\VillaPhotos\VillaPhotoResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditVillaPhoto extends EditRecord
{
    protected static string $resource = VillaPhotoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
