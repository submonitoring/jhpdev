<?php

namespace App\Filament\Submonitoring\Resources\StatusGroupResource\Pages;

use App\Filament\Submonitoring\Resources\StatusGroupResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStatusGroups extends ListRecords
{
    protected static string $resource = StatusGroupResource::class;

    use listpage;
}
