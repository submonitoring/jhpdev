<?php

namespace App\Filament\Submonitoring\Resources\DivisionSalesOrganizationResource\Pages;

use App\Filament\Submonitoring\Resources\DivisionSalesOrganizationResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewDivisionSalesOrganization extends ViewRecord
{
    protected static string $resource = DivisionSalesOrganizationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
