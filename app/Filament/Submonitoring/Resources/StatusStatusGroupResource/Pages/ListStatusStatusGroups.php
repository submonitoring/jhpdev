<?php

namespace App\Filament\Submonitoring\Resources\StatusStatusGroupResource\Pages;

use App\Filament\Submonitoring\Resources\StatusStatusGroupResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStatusStatusGroups extends ListRecords
{
    protected static string $resource = StatusStatusGroupResource::class;

    use listpage;
}
