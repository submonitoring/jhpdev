<?php

namespace App\Filament\Submonitoring\Resources\StatusGroupResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\StatusGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateStatusGroup extends CreateRecord
{
    protected static string $resource = StatusGroupResource::class;

    use createpage;
}
