<?php

namespace App\Filament\Submonitoring\Resources\StorageLocationResource\Pages;

use App\Filament\Submonitoring\Resources\StorageLocationResource;
use App\viewpage;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewStorageLocation extends ViewRecord
{
    protected static string $resource = StorageLocationResource::class;

    use viewpage;
}
