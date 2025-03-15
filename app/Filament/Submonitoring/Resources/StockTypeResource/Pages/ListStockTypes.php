<?php

namespace App\Filament\Submonitoring\Resources\StockTypeResource\Pages;

use App\Filament\Submonitoring\Resources\StockTypeResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStockTypes extends ListRecords
{
    protected static string $resource = StockTypeResource::class;

    use listpage;
}
