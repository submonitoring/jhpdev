<?php

namespace App\Filament\Submonitoring\Resources\SalesOfficeResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\SalesOfficeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSalesOffice extends EditRecord
{
    protected static string $resource = SalesOfficeResource::class;

    use editpage;
}
