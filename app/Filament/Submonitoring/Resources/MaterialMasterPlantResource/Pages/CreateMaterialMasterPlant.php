<?php

namespace App\Filament\Submonitoring\Resources\MaterialMasterPlantResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\MaterialMasterPlantResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMaterialMasterPlant extends CreateRecord
{
    protected static string $resource = MaterialMasterPlantResource::class;

    use createpage;
}
