<?php

namespace App\Filament\Submonitoring\Resources\BusinessPartnerCompanyResource\Pages;

use App\Filament\Submonitoring\Resources\BusinessPartnerCompanyResource;
use App\viewpage;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewBusinessPartnerCompany extends ViewRecord
{
    protected static string $resource = BusinessPartnerCompanyResource::class;

    use viewpage;
}
