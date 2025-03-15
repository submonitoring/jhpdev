<?php

namespace App\Filament\Submonitoring\Resources\DistributionChannelSalesOrganizationResource\Pages;

use App\Filament\Submonitoring\Resources\DistributionChannelSalesOrganizationResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDistributionChannelSalesOrganizations extends ListRecords
{
    protected static string $resource = DistributionChannelSalesOrganizationResource::class;

    use listpage;
}
