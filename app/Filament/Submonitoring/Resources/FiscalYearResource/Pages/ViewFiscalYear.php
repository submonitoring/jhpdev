<?php

namespace App\Filament\Submonitoring\Resources\FiscalYearResource\Pages;

use App\Filament\Submonitoring\Resources\FiscalYearResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewFiscalYear extends ViewRecord
{
    protected static string $resource = FiscalYearResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
