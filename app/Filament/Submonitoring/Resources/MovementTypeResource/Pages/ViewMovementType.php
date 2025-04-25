<?php

namespace App\Filament\Submonitoring\Resources\MovementTypeResource\Pages;

use App\Filament\Submonitoring\Resources\MovementTypeResource;
use App\viewpage;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMovementType extends ViewRecord
{
    protected static string $resource = MovementTypeResource::class;

    use viewpage;
}
