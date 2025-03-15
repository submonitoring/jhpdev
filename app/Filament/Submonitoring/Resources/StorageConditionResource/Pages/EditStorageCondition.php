<?php

namespace App\Filament\Submonitoring\Resources\StorageConditionResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\StorageConditionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStorageCondition extends EditRecord
{
    protected static string $resource = StorageConditionResource::class;

    use editpage;
}
