<?php

namespace App\Filament\Jhpadmin\Resources\MaterialMasterPlantResource\Pages;

use App\Filament\Jhpadmin\Resources\MaterialMasterPlantResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMaterialMasterPlants extends ListRecords
{
    protected static string $resource = MaterialMasterPlantResource::class;

    use listpage;
}
