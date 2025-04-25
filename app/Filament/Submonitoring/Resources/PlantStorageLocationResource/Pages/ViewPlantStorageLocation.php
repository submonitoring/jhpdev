<?php

namespace App\Filament\Submonitoring\Resources\PlantStorageLocationResource\Pages;

use App\Filament\Submonitoring\Resources\PlantStorageLocationResource;
use App\viewpage;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPlantStorageLocation extends ViewRecord
{
    protected static string $resource = PlantStorageLocationResource::class;

    use viewpage;
}
