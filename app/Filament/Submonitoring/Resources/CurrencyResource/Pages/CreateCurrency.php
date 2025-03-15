<?php

namespace App\Filament\Submonitoring\Resources\CurrencyResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\CurrencyResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCurrency extends CreateRecord
{
    protected static string $resource = CurrencyResource::class;

    use createpage;
}
