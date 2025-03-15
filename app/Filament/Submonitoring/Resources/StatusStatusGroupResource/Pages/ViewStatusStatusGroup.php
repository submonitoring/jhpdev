<?php

namespace App\Filament\Submonitoring\Resources\StatusStatusGroupResource\Pages;

use App\Filament\Submonitoring\Resources\StatusStatusGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewStatusStatusGroup extends ViewRecord
{
    protected static string $resource = StatusStatusGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
