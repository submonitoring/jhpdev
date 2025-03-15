<?php

namespace App\Filament\Submonitoring\Resources\MovementTypeResource\Pages;

use App\Filament\Submonitoring\Resources\MovementTypeResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMovementTypes extends ListRecords
{
    protected static string $resource = MovementTypeResource::class;

    use listpage;
}
