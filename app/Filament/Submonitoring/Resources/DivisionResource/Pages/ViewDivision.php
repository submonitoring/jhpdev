<?php

namespace App\Filament\Submonitoring\Resources\DivisionResource\Pages;

use App\Filament\Submonitoring\Resources\DivisionResource;
use App\viewpage;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewDivision extends ViewRecord
{
    protected static string $resource = DivisionResource::class;

    use viewpage;
}
