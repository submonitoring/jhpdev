<?php

namespace App\Filament\Jhpadmin\Resources\MaterialMasterResource\Pages;

use App\Filament\Jhpadmin\Resources\MaterialMasterResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMaterialMasters extends ListRecords
{
    protected static string $resource = MaterialMasterResource::class;

    use listpage;
}
