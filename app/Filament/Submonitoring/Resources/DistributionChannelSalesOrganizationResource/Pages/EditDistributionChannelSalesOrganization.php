<?php

namespace App\Filament\Submonitoring\Resources\DistributionChannelSalesOrganizationResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\DistributionChannelSalesOrganizationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDistributionChannelSalesOrganization extends EditRecord
{
    protected static string $resource = DistributionChannelSalesOrganizationResource::class;

    use editpage;
}
