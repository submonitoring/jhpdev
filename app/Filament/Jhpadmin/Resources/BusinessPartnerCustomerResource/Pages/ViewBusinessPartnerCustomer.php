<?php

namespace App\Filament\Jhpadmin\Resources\BusinessPartnerCustomerResource\Pages;

use App\Filament\Jhpadmin\Resources\BusinessPartnerCustomerResource;
use App\viewpage;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewBusinessPartnerCustomer extends ViewRecord
{
    protected static string $resource = BusinessPartnerCustomerResource::class;

    use viewpage;
}
