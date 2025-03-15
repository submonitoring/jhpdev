<?php

namespace App\Filament\Submonitoring\Resources\MaterialMasterSalesResource\Pages;

use App\Filament\Submonitoring\Resources\MaterialMasterSalesResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMaterialMasterSales extends ListRecords
{
    protected static string $resource = MaterialMasterSalesResource::class;

    use listpage;
}
