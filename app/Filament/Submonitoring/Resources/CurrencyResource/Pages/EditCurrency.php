<?php

namespace App\Filament\Submonitoring\Resources\CurrencyResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\CurrencyResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCurrency extends EditRecord
{
    protected static string $resource = CurrencyResource::class;

    use editpage;
}
