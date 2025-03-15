<?php

namespace App\Filament\Submonitoring\Resources\MaterialMasterSalesResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\MaterialMasterSalesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMaterialMasterSales extends EditRecord
{
    protected static string $resource = MaterialMasterSalesResource::class;

    use editpage;
}
