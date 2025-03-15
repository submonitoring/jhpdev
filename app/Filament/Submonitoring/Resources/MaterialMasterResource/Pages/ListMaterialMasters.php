<?php

namespace App\Filament\Submonitoring\Resources\MaterialMasterResource\Pages;

use App\Filament\Submonitoring\Resources\MaterialMasterResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMaterialMasters extends ListRecords
{
    protected static string $resource = MaterialMasterResource::class;

    use listpage;
}
