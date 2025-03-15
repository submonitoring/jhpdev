<?php

namespace App\Filament\Submonitoring\Resources\DivisionResource\Pages;

use App\Filament\Submonitoring\Resources\DivisionResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewDivision extends ViewRecord
{
    protected static string $resource = DivisionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
