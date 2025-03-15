<?php

namespace App\Filament\Submonitoring\Resources\NumberRangeResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\NumberRangeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateNumberRange extends CreateRecord
{
    protected static string $resource = NumberRangeResource::class;

    use createpage;
}
