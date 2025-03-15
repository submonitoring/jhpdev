<?php

namespace App\Filament\Submonitoring\Resources\ModuleBaaResource\Pages;

use App\Filament\Submonitoring\Resources\ModuleBaaResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListModuleBaas extends ListRecords
{
    protected static string $resource = ModuleBaaResource::class;

    use listpage;
}
