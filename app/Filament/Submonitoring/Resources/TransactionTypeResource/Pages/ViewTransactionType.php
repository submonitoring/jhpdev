<?php

namespace App\Filament\Submonitoring\Resources\TransactionTypeResource\Pages;

use App\Filament\Submonitoring\Resources\TransactionTypeResource;
use App\viewpage;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTransactionType extends ViewRecord
{
    protected static string $resource = TransactionTypeResource::class;

    use viewpage;
}
