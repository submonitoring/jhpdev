<?php

namespace App\Filament\Submonitoring\Resources\ApplicationNameResource\Pages;

use App\Filament\Submonitoring\Resources\ApplicationNameResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewApplicationName extends ViewRecord
{
    protected static string $resource = ApplicationNameResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
