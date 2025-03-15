<?php

namespace App\Filament\Submonitoring\Resources\ModuleActivityResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\ModuleActivityResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditModuleActivity extends EditRecord
{
    protected static string $resource = ModuleActivityResource::class;

    use editpage;
}
