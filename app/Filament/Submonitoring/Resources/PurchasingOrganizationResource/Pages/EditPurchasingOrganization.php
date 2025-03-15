<?php

namespace App\Filament\Submonitoring\Resources\PurchasingOrganizationResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\PurchasingOrganizationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPurchasingOrganization extends EditRecord
{
    protected static string $resource = PurchasingOrganizationResource::class;

    use editpage;
}
