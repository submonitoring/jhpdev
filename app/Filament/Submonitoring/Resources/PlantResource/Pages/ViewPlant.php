<?php

namespace App\Filament\Submonitoring\Resources\PlantResource\Pages;

use App\Filament\Submonitoring\Resources\PlantResource;
use App\viewpage;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPlant extends ViewRecord
{
    protected static string $resource = PlantResource::class;

    use viewpage;
}
