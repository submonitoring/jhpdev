<?php

namespace App\Filament\Submonitoring\Resources\ModuleActivityTypeResource\Pages;

use App\Filament\Submonitoring\Resources\ModuleActivityTypeResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListModuleActivityTypes extends ListRecords
{
    protected static string $resource = ModuleActivityTypeResource::class;

    use listpage;
}
