<?php

namespace App\Filament\Submonitoring\Resources\IndustrySectorResource\Pages;

use App\Filament\Submonitoring\Resources\IndustrySectorResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListIndustrySectors extends ListRecords
{
    protected static string $resource = IndustrySectorResource::class;

    use listpage;
}
