<?php

namespace App\Filament\Submonitoring\Resources\ModuleActivityResource\Pages;

use App\Filament\Submonitoring\Resources\ModuleActivityResource;
use App\viewpage;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewModuleActivity extends ViewRecord
{
    protected static string $resource = ModuleActivityResource::class;

    use viewpage;
}
