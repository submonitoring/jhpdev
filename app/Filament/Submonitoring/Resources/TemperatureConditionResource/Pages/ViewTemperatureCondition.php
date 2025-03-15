<?php

namespace App\Filament\Submonitoring\Resources\TemperatureConditionResource\Pages;

use App\Filament\Submonitoring\Resources\TemperatureConditionResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTemperatureCondition extends ViewRecord
{
    protected static string $resource = TemperatureConditionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
