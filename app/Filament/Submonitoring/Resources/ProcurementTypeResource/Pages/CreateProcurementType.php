<?php

namespace App\Filament\Submonitoring\Resources\ProcurementTypeResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\ProcurementTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProcurementType extends CreateRecord
{
    protected static string $resource = ProcurementTypeResource::class;

    use createpage;
}
