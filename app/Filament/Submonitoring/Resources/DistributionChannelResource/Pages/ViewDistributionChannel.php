<?php

namespace App\Filament\Submonitoring\Resources\DistributionChannelResource\Pages;

use App\Filament\Submonitoring\Resources\DistributionChannelResource;
use App\viewpage;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewDistributionChannel extends ViewRecord
{
    protected static string $resource = DistributionChannelResource::class;

    use viewpage;
}
