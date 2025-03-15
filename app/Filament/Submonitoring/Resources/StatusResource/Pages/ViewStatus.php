<?php

namespace App\Filament\Submonitoring\Resources\StatusResource\Pages;

use App\Filament\Submonitoring\Resources\StatusResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewStatus extends ViewRecord
{
    protected static string $resource = StatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
