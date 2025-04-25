<?php

namespace App\Filament\Submonitoring\Resources\SalesAreaSalesOfficeResource\Pages;

use App\Filament\Submonitoring\Resources\SalesAreaSalesOfficeResource;
use App\viewpage;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSalesAreaSalesOffice extends ViewRecord
{
    protected static string $resource = SalesAreaSalesOfficeResource::class;

    use viewpage;
}
