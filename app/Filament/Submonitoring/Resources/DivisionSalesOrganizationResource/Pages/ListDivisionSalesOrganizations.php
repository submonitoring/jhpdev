<?php

namespace App\Filament\Submonitoring\Resources\DivisionSalesOrganizationResource\Pages;

use App\Filament\Submonitoring\Resources\DivisionSalesOrganizationResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDivisionSalesOrganizations extends ListRecords
{
    protected static string $resource = DivisionSalesOrganizationResource::class;

    use listpage;
}
