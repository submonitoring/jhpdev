<?php

namespace App\Filament\Jhpadmin\Resources\BusinessPartnerResource\Pages;

use App\Filament\Jhpadmin\Resources\BusinessPartnerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBusinessPartner extends EditRecord
{
    protected static string $resource = BusinessPartnerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
