<?php

namespace App\Filament\Submonitoring\Resources\SalesAreaResource\Pages;

use App\Filament\Submonitoring\Resources\SalesAreaResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSalesAreas extends ListRecords
{
    protected static string $resource = SalesAreaResource::class;

    use listpage;
}
