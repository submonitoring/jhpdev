<?php

namespace App\Filament\Submonitoring\Resources\StorageConditionResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\StorageConditionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateStorageCondition extends CreateRecord
{
    protected static string $resource = StorageConditionResource::class;

    use createpage;
}
