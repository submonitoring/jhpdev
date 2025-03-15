<?php

namespace App\Filament\Submonitoring\Resources\MovementTypeResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\MovementTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMovementType extends EditRecord
{
    protected static string $resource = MovementTypeResource::class;

    use editpage;
}
