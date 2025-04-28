<?php

namespace App\Filament\Jhpadmin\Resources\BusinessPartnerCompanyResource\Pages;

use App\Filament\Jhpadmin\Resources\BusinessPartnerCompanyResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBusinessPartnerCompany extends EditRecord
{
    protected static string $resource = BusinessPartnerCompanyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
