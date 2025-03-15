<?php

namespace App\Filament\Submonitoring\Resources\SalesOfficeResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\SalesOfficeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSalesOffice extends CreateRecord
{
    protected static string $resource = SalesOfficeResource::class;

    use createpage;
}
