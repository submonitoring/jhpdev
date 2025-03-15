<?php

namespace App\Filament\Submonitoring\Resources\TransactionTypeResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\TransactionTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTransactionType extends CreateRecord
{
    protected static string $resource = TransactionTypeResource::class;

    use createpage;
}
