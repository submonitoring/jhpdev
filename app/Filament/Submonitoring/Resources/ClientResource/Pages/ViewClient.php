<?php

namespace App\Filament\Submonitoring\Resources\ClientResource\Pages;

use App\Filament\Submonitoring\Resources\ClientResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewClient extends ViewRecord
{
    protected static string $resource = ClientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
