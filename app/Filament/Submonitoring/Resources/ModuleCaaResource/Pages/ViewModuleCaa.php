<?php

namespace App\Filament\Submonitoring\Resources\ModuleCaaResource\Pages;

use App\Filament\Submonitoring\Resources\ModuleCaaResource;
use App\viewpage;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewModuleCaa extends ViewRecord
{
    protected static string $resource = ModuleCaaResource::class;

    use viewpage;
}
