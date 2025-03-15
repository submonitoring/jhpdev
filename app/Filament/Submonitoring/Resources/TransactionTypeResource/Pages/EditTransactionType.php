<?php

namespace App\Filament\Submonitoring\Resources\TransactionTypeResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\TransactionTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTransactionType extends EditRecord
{
    protected static string $resource = TransactionTypeResource::class;

    use editpage;
}
