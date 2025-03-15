<?php

namespace App\Filament\Submonitoring\Resources\StockTypeResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\StockTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateStockType extends CreateRecord
{
    protected static string $resource = StockTypeResource::class;

    use createpage;
}
