<?php

namespace App\Filament\Submonitoring\Resources\BusinessPartnerCustomerResource\Pages;

use App\Filament\Submonitoring\Resources\BusinessPartnerCustomerResource;
use App\viewpage;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewBusinessPartnerCustomer extends ViewRecord
{
    protected static string $resource = BusinessPartnerCustomerResource::class;

    use viewpage;
}
