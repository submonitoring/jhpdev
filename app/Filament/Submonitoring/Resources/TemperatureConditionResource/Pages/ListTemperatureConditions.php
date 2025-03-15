<?php

namespace App\Filament\Submonitoring\Resources\TemperatureConditionResource\Pages;

use App\Filament\Submonitoring\Resources\TemperatureConditionResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTemperatureConditions extends ListRecords
{
    protected static string $resource = TemperatureConditionResource::class;

    use listpage;
}
