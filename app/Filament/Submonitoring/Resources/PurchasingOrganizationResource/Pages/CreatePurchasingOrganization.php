<?php

namespace App\Filament\Submonitoring\Resources\PurchasingOrganizationResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\PurchasingOrganizationResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePurchasingOrganization extends CreateRecord
{
    protected static string $resource = PurchasingOrganizationResource::class;

    use createpage;
}
