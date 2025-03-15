<?php

namespace App\Filament\Submonitoring\Resources\StorageConditionResource\Pages;

use App\Filament\Submonitoring\Resources\StorageConditionResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStorageConditions extends ListRecords
{
    protected static string $resource = StorageConditionResource::class;

    use listpage;
}
