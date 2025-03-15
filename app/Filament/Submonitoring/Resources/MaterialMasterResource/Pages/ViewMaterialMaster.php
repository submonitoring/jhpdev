<?php

namespace App\Filament\Submonitoring\Resources\MaterialMasterResource\Pages;

use App\Filament\Submonitoring\Resources\MaterialMasterResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMaterialMaster extends ViewRecord
{
    protected static string $resource = MaterialMasterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
