<?php

namespace App\Filament\Submonitoring\Resources\DebitCreditResource\Pages;

use App\Filament\Submonitoring\Resources\DebitCreditResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDebitCredits extends ListRecords
{
    protected static string $resource = DebitCreditResource::class;

    use listpage;
}
