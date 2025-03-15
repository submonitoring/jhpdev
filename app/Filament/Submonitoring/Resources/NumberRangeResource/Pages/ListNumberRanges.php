<?php

namespace App\Filament\Submonitoring\Resources\NumberRangeResource\Pages;

use App\Filament\Submonitoring\Resources\NumberRangeResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNumberRanges extends ListRecords
{
    protected static string $resource = NumberRangeResource::class;

    use listpage;
}
