<?php

namespace App\Filament\Submonitoring\Resources\SalesAreaSalesOfficeResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\SalesAreaSalesOfficeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSalesAreaSalesOffice extends CreateRecord
{
    protected static string $resource = SalesAreaSalesOfficeResource::class;

    use createpage;
}
