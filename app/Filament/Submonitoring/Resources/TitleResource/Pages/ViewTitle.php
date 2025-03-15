<?php

namespace App\Filament\Submonitoring\Resources\TitleResource\Pages;

use App\Filament\Submonitoring\Resources\TitleResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTitle extends ViewRecord
{
    protected static string $resource = TitleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
