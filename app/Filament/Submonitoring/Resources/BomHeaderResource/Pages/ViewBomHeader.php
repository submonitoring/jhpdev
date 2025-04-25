<?php

namespace App\Filament\Submonitoring\Resources\BomHeaderResource\Pages;

use App\Filament\Submonitoring\Resources\BomHeaderResource;
use App\viewpage;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewBomHeader extends ViewRecord
{
    protected static string $resource = BomHeaderResource::class;

    use viewpage;
}
