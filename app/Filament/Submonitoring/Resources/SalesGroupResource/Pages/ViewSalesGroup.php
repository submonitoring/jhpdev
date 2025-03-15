<?php

namespace App\Filament\Submonitoring\Resources\SalesGroupResource\Pages;

use App\Filament\Submonitoring\Resources\SalesGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSalesGroup extends ViewRecord
{
    protected static string $resource = SalesGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
