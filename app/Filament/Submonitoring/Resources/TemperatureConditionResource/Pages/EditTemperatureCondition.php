<?php

namespace App\Filament\Submonitoring\Resources\TemperatureConditionResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\TemperatureConditionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTemperatureCondition extends EditRecord
{
    protected static string $resource = TemperatureConditionResource::class;

    use editpage;
}
