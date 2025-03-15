<?php

namespace App\Filament\Submonitoring\Resources\ProcurementTypeResource\Pages;

use App\Filament\Submonitoring\Resources\ProcurementTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewProcurementType extends ViewRecord
{
    protected static string $resource = ProcurementTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
