<?php

namespace App\Filament\Submonitoring\Resources\BusinessPartnerVendorResource\Pages;

use App\Filament\Submonitoring\Resources\BusinessPartnerVendorResource;
use App\viewpage;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewBusinessPartnerVendor extends ViewRecord
{
    protected static string $resource = BusinessPartnerVendorResource::class;

    use viewpage;
}
