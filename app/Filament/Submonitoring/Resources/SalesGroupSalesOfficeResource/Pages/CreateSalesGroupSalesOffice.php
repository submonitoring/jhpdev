<?php

namespace App\Filament\Submonitoring\Resources\SalesGroupSalesOfficeResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\SalesGroupSalesOfficeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSalesGroupSalesOffice extends CreateRecord
{
    protected static string $resource = SalesGroupSalesOfficeResource::class;

    use createpage;
}
