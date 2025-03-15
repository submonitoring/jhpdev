<?php

namespace App\Filament\Submonitoring\Resources\BatchSourceResource\Pages;

use App\Filament\Submonitoring\Resources\BatchSourceResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewBatchSource extends ViewRecord
{
    protected static string $resource = BatchSourceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
