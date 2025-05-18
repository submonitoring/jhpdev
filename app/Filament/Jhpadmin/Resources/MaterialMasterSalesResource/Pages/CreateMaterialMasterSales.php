<?php

namespace App\Filament\Jhpadmin\Resources\MaterialMasterSalesResource\Pages;

use App\createpage;
use App\Filament\Jhpadmin\Resources\MaterialMasterSalesResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMaterialMasterSales extends CreateRecord
{
    protected static string $resource = MaterialMasterSalesResource::class;

    use createpage;
}
