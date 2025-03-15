<?php

namespace App\Filament\Submonitoring\Resources\SalesGroupSalesOfficeResource\Pages;

use App\Filament\Submonitoring\Resources\SalesGroupSalesOfficeResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSalesGroupSalesOffices extends ListRecords
{
    protected static string $resource = SalesGroupSalesOfficeResource::class;

    use listpage;
}
