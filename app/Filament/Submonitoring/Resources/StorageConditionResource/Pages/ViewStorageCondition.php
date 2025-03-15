<?php

namespace App\Filament\Submonitoring\Resources\StorageConditionResource\Pages;

use App\Filament\Submonitoring\Resources\StorageConditionResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewStorageCondition extends ViewRecord
{
    protected static string $resource = StorageConditionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
