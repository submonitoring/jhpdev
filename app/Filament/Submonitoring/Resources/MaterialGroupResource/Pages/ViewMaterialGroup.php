<?php

namespace App\Filament\Submonitoring\Resources\MaterialGroupResource\Pages;

use App\Filament\Submonitoring\Resources\MaterialGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMaterialGroup extends ViewRecord
{
    protected static string $resource = MaterialGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
