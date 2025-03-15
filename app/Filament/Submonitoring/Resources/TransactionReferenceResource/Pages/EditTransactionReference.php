<?php

namespace App\Filament\Submonitoring\Resources\TransactionReferenceResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\TransactionReferenceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTransactionReference extends EditRecord
{
    protected static string $resource = TransactionReferenceResource::class;

    use editpage;
}
