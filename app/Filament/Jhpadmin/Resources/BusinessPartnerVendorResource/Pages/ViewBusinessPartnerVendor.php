<?php

namespace App\Filament\Jhpadmin\Resources\BusinessPartnerVendorResource\Pages;

use App\Filament\Jhpadmin\Resources\BusinessPartnerVendorResource;
use App\viewpage;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewBusinessPartnerVendor extends ViewRecord
{
    protected static string $resource = BusinessPartnerVendorResource::class;

    use viewpage;
}
