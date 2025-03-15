<?php

namespace App\Filament\Submonitoring\Resources\SalesOrganizationResource\Pages;

use App\Filament\Submonitoring\Resources\SalesOrganizationResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSalesOrganization extends ViewRecord
{
    protected static string $resource = SalesOrganizationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
