<?php

namespace App\Filament\Submonitoring\Resources\ClientResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\ClientResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateClient extends CreateRecord
{
    protected static string $resource = ClientResource::class;

    use createpage;
}
