<?php

namespace App\Filament\Submonitoring\Resources\PurchasingOrganizationResource\Pages;

use App\Filament\Submonitoring\Resources\PurchasingOrganizationResource;
use App\viewpage;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPurchasingOrganization extends ViewRecord
{
    protected static string $resource = PurchasingOrganizationResource::class;

    use viewpage;
}
