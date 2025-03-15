<?php

namespace App\Filament\Submonitoring\Resources\ApplicationNameResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\ApplicationNameResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateApplicationName extends CreateRecord
{
    protected static string $resource = ApplicationNameResource::class;

    use createpage;
}
