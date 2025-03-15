<?php

namespace App\Filament\Submonitoring\Resources\ModuleAaaResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\ModuleAaaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateModuleAaa extends CreateRecord
{
    protected static string $resource = ModuleAaaResource::class;

    use createpage;
}
