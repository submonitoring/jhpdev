<?php

namespace App\Filament\Submonitoring\Resources\BomHeaderResource\Pages;

use App\Filament\Submonitoring\Resources\BomHeaderResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBomHeaders extends ListRecords
{
    protected static string $resource = BomHeaderResource::class;

    use listpage;
}
