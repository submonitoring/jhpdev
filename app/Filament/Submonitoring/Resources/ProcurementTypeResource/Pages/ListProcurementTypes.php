<?php

namespace App\Filament\Submonitoring\Resources\ProcurementTypeResource\Pages;

use App\Filament\Submonitoring\Resources\ProcurementTypeResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProcurementTypes extends ListRecords
{
    protected static string $resource = ProcurementTypeResource::class;

    use listpage;
}
