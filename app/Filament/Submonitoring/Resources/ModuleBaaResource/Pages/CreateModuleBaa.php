<?php

namespace App\Filament\Submonitoring\Resources\ModuleBaaResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\ModuleBaaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateModuleBaa extends CreateRecord
{
    protected static string $resource = ModuleBaaResource::class;

    use createpage;
}
