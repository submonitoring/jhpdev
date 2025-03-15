<?php

namespace App\Filament\Submonitoring\Resources\IndustrySectorResource\Pages;

use App\Filament\Submonitoring\Resources\IndustrySectorResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewIndustrySector extends ViewRecord
{
    protected static string $resource = IndustrySectorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
