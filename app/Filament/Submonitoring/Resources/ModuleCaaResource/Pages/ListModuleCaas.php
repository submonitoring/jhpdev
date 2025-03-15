<?php

namespace App\Filament\Submonitoring\Resources\ModuleCaaResource\Pages;

use App\Filament\Submonitoring\Resources\ModuleCaaResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListModuleCaas extends ListRecords
{
    protected static string $resource = ModuleCaaResource::class;

    use listpage;
}
