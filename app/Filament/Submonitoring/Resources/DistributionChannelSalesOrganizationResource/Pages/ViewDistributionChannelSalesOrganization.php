<?php

namespace App\Filament\Submonitoring\Resources\DistributionChannelSalesOrganizationResource\Pages;

use App\Filament\Submonitoring\Resources\DistributionChannelSalesOrganizationResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewDistributionChannelSalesOrganization extends ViewRecord
{
    protected static string $resource = DistributionChannelSalesOrganizationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
