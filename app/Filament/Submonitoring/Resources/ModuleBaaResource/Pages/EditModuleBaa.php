<?php

namespace App\Filament\Submonitoring\Resources\ModuleBaaResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\ModuleBaaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditModuleBaa extends EditRecord
{
    protected static string $resource = ModuleBaaResource::class;

    use editpage;
}
