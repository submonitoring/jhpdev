<?php

namespace App\Filament\Submonitoring\Resources\StorageLocationResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\StorageLocationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStorageLocation extends EditRecord
{
    protected static string $resource = StorageLocationResource::class;

    use editpage;
}
