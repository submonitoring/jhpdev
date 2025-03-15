<?php

namespace App\Filament\Submonitoring\Resources\SalesAreaResource\Pages;

use App\Filament\Submonitoring\Resources\SalesAreaResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSalesArea extends ViewRecord
{
    protected static string $resource = SalesAreaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
