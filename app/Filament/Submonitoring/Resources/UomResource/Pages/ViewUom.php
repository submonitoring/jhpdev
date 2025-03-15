<?php

namespace App\Filament\Submonitoring\Resources\UomResource\Pages;

use App\Filament\Submonitoring\Resources\UomResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewUom extends ViewRecord
{
    protected static string $resource = UomResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
