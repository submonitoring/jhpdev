<?php

namespace App\Filament\Submonitoring\Resources\BusinessPartnerResource\Pages;

use App\Filament\Submonitoring\Resources\BusinessPartnerResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewBusinessPartner extends ViewRecord
{
    protected static string $resource = BusinessPartnerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
