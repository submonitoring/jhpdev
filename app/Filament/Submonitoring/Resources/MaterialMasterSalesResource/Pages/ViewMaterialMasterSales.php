<?php

namespace App\Filament\Submonitoring\Resources\MaterialMasterSalesResource\Pages;

use App\Filament\Submonitoring\Resources\MaterialMasterSalesResource;
use App\viewpage;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMaterialMasterSales extends ViewRecord
{
    protected static string $resource = MaterialMasterSalesResource::class;

    use viewpage;
}
