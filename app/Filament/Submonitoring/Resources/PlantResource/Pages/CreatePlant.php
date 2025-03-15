<?php

namespace App\Filament\Submonitoring\Resources\PlantResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\PlantResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePlant extends CreateRecord
{
    protected static string $resource = PlantResource::class;

    use createpage;
}
