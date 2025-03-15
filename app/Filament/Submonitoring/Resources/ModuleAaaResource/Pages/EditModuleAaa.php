<?php

namespace App\Filament\Submonitoring\Resources\ModuleAaaResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\ModuleAaaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditModuleAaa extends EditRecord
{
    protected static string $resource = ModuleAaaResource::class;

    use editpage;
}
