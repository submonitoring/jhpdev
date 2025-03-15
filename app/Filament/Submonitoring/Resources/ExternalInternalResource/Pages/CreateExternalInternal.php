<?php

namespace App\Filament\Submonitoring\Resources\ExternalInternalResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\ExternalInternalResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateExternalInternal extends CreateRecord
{
    protected static string $resource = ExternalInternalResource::class;

    use createpage;
}
