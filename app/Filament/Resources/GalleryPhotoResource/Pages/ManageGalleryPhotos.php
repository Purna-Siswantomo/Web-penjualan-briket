<?php

namespace App\Filament\Resources\GalleryPhotoResource\Pages;

use App\Filament\Resources\GalleryPhotoResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageGalleryPhotos extends ManageRecords
{
    protected static string $resource = GalleryPhotoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
