<?php

namespace App\Filament\Submonitoring\Resources\ModuleAaaResource\Pages;

use App\Filament\Submonitoring\Resources\ModuleAaaResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListModuleAaas extends ListRecords
{
    protected static string $resource = ModuleAaaResource::class;

    use listpage;
}
