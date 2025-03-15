<?php

namespace App\Filament\Submonitoring\Resources\BpCategoryResource\Pages;

use App\Filament\Submonitoring\Resources\BpCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewBpCategory extends ViewRecord
{
    protected static string $resource = BpCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
