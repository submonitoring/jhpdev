<?php

namespace App\Filament\Submonitoring\Resources\PlantStorageLocationResource\Pages;

use App\Filament\Submonitoring\Resources\PlantStorageLocationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPlantStorageLocations extends ListRecords
{
    protected static string $resource = PlantStorageLocationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
