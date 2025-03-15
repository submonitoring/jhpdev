<?php

namespace App\Filament\Submonitoring\Resources\ExternalInternalResource\Pages;

use App\Filament\Submonitoring\Resources\ExternalInternalResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListExternalInternals extends ListRecords
{
    protected static string $resource = ExternalInternalResource::class;

    use listpage;
}
