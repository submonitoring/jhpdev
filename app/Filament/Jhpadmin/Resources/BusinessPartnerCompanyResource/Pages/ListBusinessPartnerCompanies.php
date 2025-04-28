<?php

namespace App\Filament\Jhpadmin\Resources\BusinessPartnerCompanyResource\Pages;

use App\Filament\Jhpadmin\Resources\BusinessPartnerCompanyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBusinessPartnerCompanies extends ListRecords
{
    protected static string $resource = BusinessPartnerCompanyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
