<?php

namespace App\Filament\Submonitoring\Resources\DebitCreditResource\Pages;

use App\Filament\Submonitoring\Resources\DebitCreditResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewDebitCredit extends ViewRecord
{
    protected static string $resource = DebitCreditResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
