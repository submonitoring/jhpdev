<?php

namespace App\Filament\Jhpadmin\Resources\BusinessPartnerResource\Pages;

use App\Filament\Jhpadmin\Resources\BusinessPartnerResource;
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
