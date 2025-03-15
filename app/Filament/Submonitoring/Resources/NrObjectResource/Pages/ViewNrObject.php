<?php

namespace App\Filament\Submonitoring\Resources\NrObjectResource\Pages;

use App\Filament\Submonitoring\Resources\NrObjectResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewNrObject extends ViewRecord
{
    protected static string $resource = NrObjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
