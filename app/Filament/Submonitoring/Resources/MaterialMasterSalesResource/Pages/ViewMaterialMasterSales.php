<?php

namespace App\Filament\Submonitoring\Resources\MaterialMasterSalesResource\Pages;

use App\Filament\Submonitoring\Resources\MaterialMasterSalesResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMaterialMasterSales extends ViewRecord
{
    protected static string $resource = MaterialMasterSalesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
