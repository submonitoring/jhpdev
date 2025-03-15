<?php

namespace App\Filament\Submonitoring\Resources\ModuleActivityTypeResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\ModuleActivityTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditModuleActivityType extends EditRecord
{
    protected static string $resource = ModuleActivityTypeResource::class;

    use editpage;
}
