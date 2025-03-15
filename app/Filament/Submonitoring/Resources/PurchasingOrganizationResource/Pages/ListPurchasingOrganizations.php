<?php

namespace App\Filament\Submonitoring\Resources\PurchasingOrganizationResource\Pages;

use App\Filament\Submonitoring\Resources\PurchasingOrganizationResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPurchasingOrganizations extends ListRecords
{
    protected static string $resource = PurchasingOrganizationResource::class;

    use listpage;
}
