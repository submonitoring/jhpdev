<?php

namespace App\Filament\Submonitoring\Resources\BusinessPartnerVendorResource\Pages;

use App\Filament\Submonitoring\Resources\BusinessPartnerVendorResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewBusinessPartnerVendor extends ViewRecord
{
    protected static string $resource = BusinessPartnerVendorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
