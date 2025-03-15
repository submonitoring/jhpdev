<?php

namespace App\Filament\Submonitoring\Resources\PlantStorageLocationResource\Pages;

use App\Filament\Submonitoring\Resources\PlantStorageLocationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPlantStorageLocation extends EditRecord
{
    protected static string $resource = PlantStorageLocationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
