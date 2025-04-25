<?php

namespace App\Filament\Submonitoring\Resources\ClientResource\Pages;

use App\Filament\Submonitoring\Resources\ClientResource;
use App\viewpage;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewClient extends ViewRecord
{
    protected static string $resource = ClientResource::class;

    use viewpage;
}
