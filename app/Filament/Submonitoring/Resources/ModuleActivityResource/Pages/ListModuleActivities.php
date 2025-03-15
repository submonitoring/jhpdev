<?php

namespace App\Filament\Submonitoring\Resources\ModuleActivityResource\Pages;

use App\Filament\Submonitoring\Resources\ModuleActivityResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListModuleActivities extends ListRecords
{
    protected static string $resource = ModuleActivityResource::class;

    use listpage;
}
