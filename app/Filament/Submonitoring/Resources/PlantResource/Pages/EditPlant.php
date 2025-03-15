<?php

namespace App\Filament\Submonitoring\Resources\PlantResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\PlantResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPlant extends EditRecord
{
    protected static string $resource = PlantResource::class;

    use editpage;
}
