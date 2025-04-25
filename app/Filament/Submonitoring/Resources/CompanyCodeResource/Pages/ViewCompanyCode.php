<?php

namespace App\Filament\Submonitoring\Resources\CompanyCodeResource\Pages;

use App\Filament\Submonitoring\Resources\CompanyCodeResource;
use App\viewpage;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCompanyCode extends ViewRecord
{
    protected static string $resource = CompanyCodeResource::class;

    use viewpage;
}
