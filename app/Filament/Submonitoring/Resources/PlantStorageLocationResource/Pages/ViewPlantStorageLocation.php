<?php

namespace App\Filament\Submonitoring\Resources\PlantStorageLocationResource\Pages;

use App\Filament\Submonitoring\Resources\PlantStorageLocationResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPlantStorageLocation extends ViewRecord
{
    protected static string $resource = PlantStorageLocationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
