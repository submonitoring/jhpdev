<?php

namespace App\Filament\Submonitoring\Resources\ModuleActivityTypeResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\ModuleActivityTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateModuleActivityType extends CreateRecord
{
    protected static string $resource = ModuleActivityTypeResource::class;

    use createpage;
}
