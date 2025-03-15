<?php

namespace App\Filament\Submonitoring\Resources\DistributionChannelResource\Pages;

use App\Filament\Submonitoring\Resources\DistributionChannelResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDistributionChannels extends ListRecords
{
    protected static string $resource = DistributionChannelResource::class;

    use listpage;
}
