<?php

namespace App\Filament\Submonitoring\Resources\MaterialMasterPlantResource\Pages;

use App\Filament\Submonitoring\Resources\MaterialMasterPlantResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMaterialMasterPlant extends ViewRecord
{
    protected static string $resource = MaterialMasterPlantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
