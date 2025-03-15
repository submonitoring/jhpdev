<?php

namespace App\Filament\Submonitoring\Resources\DistributionChannelResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\DistributionChannelResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDistributionChannel extends CreateRecord
{
    protected static string $resource = DistributionChannelResource::class;

    use createpage;
}
