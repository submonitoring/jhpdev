<?php

namespace App\Filament\Submonitoring\Resources\SalesAreaSalesOfficeResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\SalesAreaSalesOfficeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSalesAreaSalesOffice extends EditRecord
{
    protected static string $resource = SalesAreaSalesOfficeResource::class;

    use editpage;
}
