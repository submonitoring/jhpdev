<?php

namespace App\Filament\Submonitoring\Resources\StockTypeResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\StockTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStockType extends EditRecord
{
    protected static string $resource = StockTypeResource::class;

    use editpage;
}
