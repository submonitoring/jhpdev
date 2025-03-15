<?php

namespace App\Filament\Submonitoring\Resources\ModuleAaaResource\Pages;

use App\Filament\Submonitoring\Resources\ModuleAaaResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewModuleAaa extends ViewRecord
{
    protected static string $resource = ModuleAaaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
