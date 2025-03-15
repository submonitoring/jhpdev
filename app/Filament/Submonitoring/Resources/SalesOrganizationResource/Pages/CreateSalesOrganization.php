<?php

namespace App\Filament\Submonitoring\Resources\SalesOrganizationResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\SalesOrganizationResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSalesOrganization extends CreateRecord
{
    protected static string $resource = SalesOrganizationResource::class;

    use createpage;
}
