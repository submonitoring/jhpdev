<?php

namespace App\Filament\Submonitoring\Resources\NumberRangeResource\Pages;

use App\Filament\Submonitoring\Resources\NumberRangeResource;
use App\viewpage;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewNumberRange extends ViewRecord
{
    protected static string $resource = NumberRangeResource::class;

    use viewpage;
}
