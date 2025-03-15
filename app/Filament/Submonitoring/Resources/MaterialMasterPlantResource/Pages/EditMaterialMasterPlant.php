<?php

namespace App\Filament\Submonitoring\Resources\MaterialMasterPlantResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\MaterialMasterPlantResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMaterialMasterPlant extends EditRecord
{
    protected static string $resource = MaterialMasterPlantResource::class;

    use editpage;
}
