<?php

namespace App\Filament\Submonitoring\Resources\SalesAreaSalesOfficeResource\Pages;

use App\Filament\Submonitoring\Resources\SalesAreaSalesOfficeResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSalesAreaSalesOffice extends ViewRecord
{
    protected static string $resource = SalesAreaSalesOfficeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
