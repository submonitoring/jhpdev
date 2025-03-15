<?php

namespace App\Filament\Submonitoring\Resources\ExternalInternalResource\Pages;

use App\Filament\Submonitoring\Resources\ExternalInternalResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewExternalInternal extends ViewRecord
{
    protected static string $resource = ExternalInternalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
