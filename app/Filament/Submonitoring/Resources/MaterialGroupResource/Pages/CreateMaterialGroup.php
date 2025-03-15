<?php

namespace App\Filament\Submonitoring\Resources\MaterialGroupResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\MaterialGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMaterialGroup extends CreateRecord
{
    protected static string $resource = MaterialGroupResource::class;

    use createpage;
}
