<?php

namespace App\Filament\Submonitoring\Resources\NumberRangeResource\Pages;

use App\Filament\Submonitoring\Resources\NumberRangeResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewNumberRange extends ViewRecord
{
    protected static string $resource = NumberRangeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
