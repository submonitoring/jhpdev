<?php

namespace App\Filament\Submonitoring\Resources\SalesGroupSalesOfficeResource\Pages;

use App\Filament\Submonitoring\Resources\SalesGroupSalesOfficeResource;
use App\viewpage;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSalesGroupSalesOffice extends ViewRecord
{
    protected static string $resource = SalesGroupSalesOfficeResource::class;

    use viewpage;
}
