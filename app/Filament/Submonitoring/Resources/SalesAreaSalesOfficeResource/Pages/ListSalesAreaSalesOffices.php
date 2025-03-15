<?php

namespace App\Filament\Submonitoring\Resources\SalesAreaSalesOfficeResource\Pages;

use App\Filament\Submonitoring\Resources\SalesAreaSalesOfficeResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSalesAreaSalesOffices extends ListRecords
{
    protected static string $resource = SalesAreaSalesOfficeResource::class;

    use listpage;
}
