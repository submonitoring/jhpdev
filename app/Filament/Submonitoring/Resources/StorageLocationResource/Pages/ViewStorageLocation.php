<?php

namespace App\Filament\Submonitoring\Resources\StorageLocationResource\Pages;

use App\Filament\Submonitoring\Resources\StorageLocationResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewStorageLocation extends ViewRecord
{
    protected static string $resource = StorageLocationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
