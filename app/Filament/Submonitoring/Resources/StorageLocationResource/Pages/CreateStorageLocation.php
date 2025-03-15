<?php

namespace App\Filament\Submonitoring\Resources\StorageLocationResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\StorageLocationResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateStorageLocation extends CreateRecord
{
    protected static string $resource = StorageLocationResource::class;

    use createpage;
}
