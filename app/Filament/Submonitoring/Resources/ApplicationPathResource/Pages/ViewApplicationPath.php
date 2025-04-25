<?php

namespace App\Filament\Submonitoring\Resources\ApplicationPathResource\Pages;

use App\Filament\Submonitoring\Resources\ApplicationPathResource;
use App\viewpage;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewApplicationPath extends ViewRecord
{
    protected static string $resource = ApplicationPathResource::class;

    use viewpage;
}
