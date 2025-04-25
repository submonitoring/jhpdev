<?php

namespace App\Filament\Submonitoring\Resources\BomTypeResource\Pages;

use App\Filament\Submonitoring\Resources\BomTypeResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBomTypes extends ListRecords
{
    protected static string $resource = BomTypeResource::class;

    use listpage;
}
