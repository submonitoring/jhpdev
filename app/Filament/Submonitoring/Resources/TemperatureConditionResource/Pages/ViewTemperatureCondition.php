<?php

namespace App\Filament\Submonitoring\Resources\TemperatureConditionResource\Pages;

use App\Filament\Submonitoring\Resources\TemperatureConditionResource;
use App\viewpage;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTemperatureCondition extends ViewRecord
{
    protected static string $resource = TemperatureConditionResource::class;

    use viewpage;
}
