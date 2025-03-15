<?php

namespace App\Filament\Submonitoring\Resources\ModuleActivityResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\ModuleActivityResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateModuleActivity extends CreateRecord
{
    protected static string $resource = ModuleActivityResource::class;

    use createpage;
}
