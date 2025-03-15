<?php

namespace App\Filament\Submonitoring\Resources\SalesGroupResource\Pages;

use App\Filament\Submonitoring\Resources\SalesGroupResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSalesGroups extends ListRecords
{
    protected static string $resource = SalesGroupResource::class;

    use listpage;
}
