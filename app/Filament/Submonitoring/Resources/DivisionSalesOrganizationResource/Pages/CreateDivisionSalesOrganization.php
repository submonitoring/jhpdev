<?php

namespace App\Filament\Submonitoring\Resources\DivisionSalesOrganizationResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\DivisionSalesOrganizationResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDivisionSalesOrganization extends CreateRecord
{
    protected static string $resource = DivisionSalesOrganizationResource::class;

    use createpage;
}
