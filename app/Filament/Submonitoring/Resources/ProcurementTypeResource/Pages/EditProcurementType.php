<?php

namespace App\Filament\Submonitoring\Resources\ProcurementTypeResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\ProcurementTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProcurementType extends EditRecord
{
    protected static string $resource = ProcurementTypeResource::class;

    use editpage;
}
