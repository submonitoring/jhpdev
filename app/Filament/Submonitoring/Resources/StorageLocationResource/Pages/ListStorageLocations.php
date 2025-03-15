<?php

namespace App\Filament\Submonitoring\Resources\StorageLocationResource\Pages;

use App\Filament\Submonitoring\Resources\StorageLocationResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStorageLocations extends ListRecords
{
    protected static string $resource = StorageLocationResource::class;

    use listpage;
}
