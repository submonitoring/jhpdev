<?php

namespace App\Filament\Submonitoring\Resources\MovementTypeResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\MovementTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMovementType extends CreateRecord
{
    protected static string $resource = MovementTypeResource::class;

    use createpage;
}
