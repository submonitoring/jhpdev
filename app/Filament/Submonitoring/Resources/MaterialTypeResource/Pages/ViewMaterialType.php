<?php

namespace App\Filament\Submonitoring\Resources\MaterialTypeResource\Pages;

use App\Filament\Submonitoring\Resources\MaterialTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMaterialType extends ViewRecord
{
    protected static string $resource = MaterialTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
