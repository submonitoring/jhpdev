<?php

namespace App\Filament\Submonitoring\Resources\NrObjectResource\Pages;

use App\Filament\Submonitoring\Resources\NrObjectResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNrObjects extends ListRecords
{
    protected static string $resource = NrObjectResource::class;

    use listpage;
}
