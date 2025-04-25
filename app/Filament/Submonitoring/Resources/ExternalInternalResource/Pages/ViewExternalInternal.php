<?php

namespace App\Filament\Submonitoring\Resources\ExternalInternalResource\Pages;

use App\Filament\Submonitoring\Resources\ExternalInternalResource;
use App\viewpage;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewExternalInternal extends ViewRecord
{
    protected static string $resource = ExternalInternalResource::class;

    use viewpage;
}
