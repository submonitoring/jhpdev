<?php

namespace App\Filament\Submonitoring\Resources\NrObjectResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\NrObjectResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateNrObject extends CreateRecord
{
    protected static string $resource = NrObjectResource::class;

    use createpage;
}
