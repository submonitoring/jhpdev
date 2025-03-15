<?php

namespace App\Filament\Submonitoring\Resources\ModuleCaaResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\ModuleCaaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateModuleCaa extends CreateRecord
{
    protected static string $resource = ModuleCaaResource::class;

    use createpage;
}
