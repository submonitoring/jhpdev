<?php

namespace App\Filament\Submonitoring\Resources\ModuleActivityTypeResource\Pages;

use App\Filament\Submonitoring\Resources\ModuleActivityTypeResource;
use App\viewpage;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewModuleActivityType extends ViewRecord
{
    protected static string $resource = ModuleActivityTypeResource::class;

    use viewpage;
}
