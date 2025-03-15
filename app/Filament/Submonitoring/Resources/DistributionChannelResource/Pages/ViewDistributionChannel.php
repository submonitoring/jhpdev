<?php

namespace App\Filament\Submonitoring\Resources\DistributionChannelResource\Pages;

use App\Filament\Submonitoring\Resources\DistributionChannelResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewDistributionChannel extends ViewRecord
{
    protected static string $resource = DistributionChannelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
