<?php

namespace App\Filament\Submonitoring\Resources\ModuleCaaResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\ModuleCaaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditModuleCaa extends EditRecord
{
    protected static string $resource = ModuleCaaResource::class;

    use editpage;
}
