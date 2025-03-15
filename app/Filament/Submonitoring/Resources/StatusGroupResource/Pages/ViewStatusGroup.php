<?php

namespace App\Filament\Submonitoring\Resources\StatusGroupResource\Pages;

use App\Filament\Submonitoring\Resources\StatusGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewStatusGroup extends ViewRecord
{
    protected static string $resource = StatusGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
