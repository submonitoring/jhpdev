<?php

namespace App\Filament\Submonitoring\Resources\MaterialMasterPlantResource\Pages;

use App\Filament\Submonitoring\Resources\MaterialMasterPlantResource;
use App\viewpage;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMaterialMasterPlant extends ViewRecord
{
    protected static string $resource = MaterialMasterPlantResource::class;

    use viewpage;
}
