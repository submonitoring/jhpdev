<?php

namespace App\Filament\Submonitoring\Resources\BusinessPartnerResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\BusinessPartnerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBusinessPartner extends EditRecord
{
    protected static string $resource = BusinessPartnerResource::class;

    use editpage;
}
