<?php

namespace App\Filament\Submonitoring\Resources\SalesOfficeResource\Pages;

use App\Filament\Submonitoring\Resources\SalesOfficeResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSalesOffice extends ViewRecord
{
    protected static string $resource = SalesOfficeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
