<?php

namespace App\Filament\Submonitoring\Resources\BomTypeResource\Pages;

use App\Filament\Submonitoring\Resources\BomTypeResource;
use App\viewpage;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewBomType extends ViewRecord
{
    protected static string $resource = BomTypeResource::class;

    use viewpage;
}
