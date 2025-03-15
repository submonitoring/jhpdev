<?php

namespace App\Filament\Submonitoring\Resources\MaterialGroupResource\Pages;

use App\Filament\Submonitoring\Resources\MaterialGroupResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMaterialGroups extends ListRecords
{
    protected static string $resource = MaterialGroupResource::class;

    use listpage;
}
