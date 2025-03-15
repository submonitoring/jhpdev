<?php

namespace App\Filament\Submonitoring\Resources\DistributionChannelSalesOrganizationResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\DistributionChannelSalesOrganizationResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDistributionChannelSalesOrganization extends CreateRecord
{
    protected static string $resource = DistributionChannelSalesOrganizationResource::class;

    use createpage;
}
