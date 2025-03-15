<?php

namespace App\Filament\Submonitoring\Resources\TransactionReferenceResource\Pages;

use App\Filament\Submonitoring\Resources\TransactionReferenceResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTransactionReference extends ViewRecord
{
    protected static string $resource = TransactionReferenceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
