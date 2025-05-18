<?php

namespace App\Filament\Jhpadmin\Resources\MaterialMasterSalesResource\Pages;

use App\Filament\Jhpadmin\Resources\MaterialMasterSalesResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMaterialMasterSales extends ListRecords
{
    protected static string $resource = MaterialMasterSalesResource::class;

    use listpage;
}
