<?php

namespace App\Filament\Submonitoring\Resources\StatusResource\Pages;

use App\Filament\Submonitoring\Resources\StatusResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStatuses extends ListRecords
{
    protected static string $resource = StatusResource::class;

    use listpage;
}
