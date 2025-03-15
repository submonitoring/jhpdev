<?php

namespace App\Filament\Submonitoring\Resources\BomItemResource\Pages;

use App\Filament\Submonitoring\Resources\BomItemResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewBomItem extends ViewRecord
{
    protected static string $resource = BomItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
