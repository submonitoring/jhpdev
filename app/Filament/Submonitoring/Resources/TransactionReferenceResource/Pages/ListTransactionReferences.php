<?php

namespace App\Filament\Submonitoring\Resources\TransactionReferenceResource\Pages;

use App\Filament\Submonitoring\Resources\TransactionReferenceResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTransactionReferences extends ListRecords
{
    protected static string $resource = TransactionReferenceResource::class;

    use listpage;
}
