<?php

namespace App\Filament\Submonitoring\Resources\PlantResource\Pages;

use App\Filament\Submonitoring\Resources\PlantResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPlants extends ListRecords
{
    protected static string $resource = PlantResource::class;

    use listpage;
}
