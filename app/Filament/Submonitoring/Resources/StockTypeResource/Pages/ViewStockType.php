<?php

namespace App\Filament\Submonitoring\Resources\StockTypeResource\Pages;

use App\Filament\Submonitoring\Resources\StockTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewStockType extends ViewRecord
{
    protected static string $resource = StockTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
