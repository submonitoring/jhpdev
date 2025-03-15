<?php

namespace App\Filament\Submonitoring\Resources\DistributionChannelResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\DistributionChannelResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDistributionChannel extends EditRecord
{
    protected static string $resource = DistributionChannelResource::class;

    use editpage;
}
