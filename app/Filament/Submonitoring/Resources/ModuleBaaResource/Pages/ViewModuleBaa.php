<?php

namespace App\Filament\Submonitoring\Resources\ModuleBaaResource\Pages;

use App\Filament\Submonitoring\Resources\ModuleBaaResource;
use App\viewpage;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewModuleBaa extends ViewRecord
{
    protected static string $resource = ModuleBaaResource::class;

    use viewpage;
}
