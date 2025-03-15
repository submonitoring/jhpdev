<?php

namespace App\Filament\Submonitoring\Resources\BomHeaderResource\Pages;

use App\Filament\Submonitoring\Resources\BomHeaderResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewBomHeader extends ViewRecord
{
    protected static string $resource = BomHeaderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
