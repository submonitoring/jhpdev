<?php

namespace App\Filament\Submonitoring\Resources\SalesOfficeResource\Pages;

use App\Filament\Submonitoring\Resources\SalesOfficeResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSalesOffices extends ListRecords
{
    protected static string $resource = SalesOfficeResource::class;

    use listpage;
}
