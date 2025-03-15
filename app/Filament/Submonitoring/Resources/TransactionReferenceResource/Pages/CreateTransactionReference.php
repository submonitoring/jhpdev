<?php

namespace App\Filament\Submonitoring\Resources\TransactionReferenceResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\TransactionReferenceResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTransactionReference extends CreateRecord
{
    protected static string $resource = TransactionReferenceResource::class;

    use createpage;
}
