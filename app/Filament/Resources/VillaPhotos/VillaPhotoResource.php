<?php

namespace App\Filament\Resources\VillaPhotos;

use App\Filament\Resources\VillaPhotos\Pages\CreateVillaPhoto;
use App\Filament\Resources\VillaPhotos\Pages\EditVillaPhoto;
use App\Filament\Resources\VillaPhotos\Pages\ListVillaPhotos;
use App\Filament\Resources\VillaPhotos\Pages\ViewVillaPhoto;
use App\Filament\Resources\VillaPhotos\Schemas\VillaPhotoForm;
use App\Filament\Resources\VillaPhotos\Schemas\VillaPhotoInfolist;
use App\Filament\Resources\VillaPhotos\Tables\VillaPhotosTable;
use App\Models\VillaPhoto;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class VillaPhotoResource extends Resource
{
    protected static ?string $model = VillaPhoto::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-photo';

    protected static ?string $recordTitleAttribute = 'foto';

    public static function form(Schema $schema): Schema
    {
        return VillaPhotoForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return VillaPhotoInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return VillaPhotosTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListVillaPhotos::route('/'),
            'create' => CreateVillaPhoto::route('/create'),
            'view' => ViewVillaPhoto::route('/{record}'),
            'edit' => EditVillaPhoto::route('/{record}/edit'),
        ];
    }
}
