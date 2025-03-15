<?php

namespace App\Filament\Submonitoring\Resources\SalesGroupSalesOfficeResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\SalesGroupSalesOfficeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSalesGroupSalesOffice extends EditRecord
{
    protected static string $resource = SalesGroupSalesOfficeResource::class;

    use editpage;
}
