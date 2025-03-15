<?php

namespace App\Filament\Submonitoring\Resources\ApplicationNameResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\ApplicationNameResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditApplicationName extends EditRecord
{
    protected static string $resource = ApplicationNameResource::class;

    use editpage;
}
