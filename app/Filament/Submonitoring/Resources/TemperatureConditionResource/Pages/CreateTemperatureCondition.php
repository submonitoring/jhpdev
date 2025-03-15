<?php

namespace App\Filament\Submonitoring\Resources\TemperatureConditionResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\TemperatureConditionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTemperatureCondition extends CreateRecord
{
    protected static string $resource = TemperatureConditionResource::class;

    use createpage;
}
