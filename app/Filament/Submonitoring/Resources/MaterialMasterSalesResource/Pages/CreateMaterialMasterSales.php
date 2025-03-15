<?php

namespace App\Filament\Submonitoring\Resources\MaterialMasterSalesResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\MaterialMasterSalesResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMaterialMasterSales extends CreateRecord
{
    protected static string $resource = MaterialMasterSalesResource::class;

    use createpage;
}
