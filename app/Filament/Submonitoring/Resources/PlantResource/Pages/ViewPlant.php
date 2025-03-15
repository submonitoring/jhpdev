<?php

namespace App\Filament\Submonitoring\Resources\PlantResource\Pages;

use App\Filament\Submonitoring\Resources\PlantResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPlant extends ViewRecord
{
    protected static string $resource = PlantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
