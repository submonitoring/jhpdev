<?php

namespace App\Filament\Submonitoring\Resources\MaterialTypeResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\MaterialTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMaterialType extends CreateRecord
{
    protected static string $resource = MaterialTypeResource::class;

    use createpage;
}
