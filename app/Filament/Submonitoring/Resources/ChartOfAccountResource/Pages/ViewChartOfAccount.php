<?php

namespace App\Filament\Submonitoring\Resources\ChartOfAccountResource\Pages;

use App\Filament\Submonitoring\Resources\ChartOfAccountResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewChartOfAccount extends ViewRecord
{
    protected static string $resource = ChartOfAccountResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
