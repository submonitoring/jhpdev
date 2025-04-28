<?php

namespace App\Filament\Jhpadmin\Resources\BusinessPartnerCompanyResource\Pages;

use App\Filament\Jhpadmin\Resources\BusinessPartnerCompanyResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewBusinessPartnerCompany extends ViewRecord
{
    protected static string $resource = BusinessPartnerCompanyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
