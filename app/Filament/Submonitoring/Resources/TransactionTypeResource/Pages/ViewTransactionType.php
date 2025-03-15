<?php

namespace App\Filament\Submonitoring\Resources\TransactionTypeResource\Pages;

use App\Filament\Submonitoring\Resources\TransactionTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTransactionType extends ViewRecord
{
    protected static string $resource = TransactionTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
