<?php

namespace App\Filament\Submonitoring\Resources\DivisionResource\Pages;

use App\Filament\Submonitoring\Resources\DivisionResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDivisions extends ListRecords
{
    protected static string $resource = DivisionResource::class;

    use listpage;
}
