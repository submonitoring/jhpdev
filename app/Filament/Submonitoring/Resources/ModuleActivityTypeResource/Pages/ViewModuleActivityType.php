<?php

namespace App\Filament\Submonitoring\Resources\ModuleActivityTypeResource\Pages;

use App\Filament\Submonitoring\Resources\ModuleActivityTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewModuleActivityType extends ViewRecord
{
    protected static string $resource = ModuleActivityTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
