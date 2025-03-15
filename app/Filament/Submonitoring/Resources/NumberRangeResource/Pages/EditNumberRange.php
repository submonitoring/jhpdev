<?php

namespace App\Filament\Submonitoring\Resources\NumberRangeResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\NumberRangeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNumberRange extends EditRecord
{
    protected static string $resource = NumberRangeResource::class;

    use editpage;
}
