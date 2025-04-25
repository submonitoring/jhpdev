<?php

namespace App\Filament\Submonitoring\Resources\DivisionSalesOrganizationResource\Pages;

use App\Filament\Submonitoring\Resources\DivisionSalesOrganizationResource;
use App\viewpage;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewDivisionSalesOrganization extends ViewRecord
{
    protected static string $resource = DivisionSalesOrganizationResource::class;

    use viewpage;
}
