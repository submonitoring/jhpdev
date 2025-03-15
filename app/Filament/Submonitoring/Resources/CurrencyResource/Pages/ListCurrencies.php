<?php

namespace App\Filament\Submonitoring\Resources\CurrencyResource\Pages;

use App\Filament\Submonitoring\Resources\CurrencyResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCurrencies extends ListRecords
{
    protected static string $resource = CurrencyResource::class;

    use listpage;
}
