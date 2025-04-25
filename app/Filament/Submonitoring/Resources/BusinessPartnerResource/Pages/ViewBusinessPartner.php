<?php

namespace App\Filament\Submonitoring\Resources\BusinessPartnerResource\Pages;

use App\Filament\Submonitoring\Resources\BusinessPartnerResource;
use App\viewpage;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewBusinessPartner extends ViewRecord
{
    protected static string $resource = BusinessPartnerResource::class;

    use viewpage;
}
