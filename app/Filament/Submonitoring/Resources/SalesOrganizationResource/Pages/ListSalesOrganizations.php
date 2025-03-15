<?php

namespace App\Filament\Submonitoring\Resources\SalesOrganizationResource\Pages;

use App\Filament\Submonitoring\Resources\SalesOrganizationResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSalesOrganizations extends ListRecords
{
    protected static string $resource = SalesOrganizationResource::class;

    use listpage;
}
