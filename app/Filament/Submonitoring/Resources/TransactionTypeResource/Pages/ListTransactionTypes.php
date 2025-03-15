<?php

namespace App\Filament\Submonitoring\Resources\TransactionTypeResource\Pages;

use App\Filament\Submonitoring\Resources\TransactionTypeResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTransactionTypes extends ListRecords
{
    protected static string $resource = TransactionTypeResource::class;

    use listpage;
}
