<?php

namespace App\Filament\Submonitoring\Resources\StorageConditionResource\Pages;

use App\Filament\Submonitoring\Resources\StorageConditionResource;
use App\viewpage;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewStorageCondition extends ViewRecord
{
    protected static string $resource = StorageConditionResource::class;

    use viewpage;
}
