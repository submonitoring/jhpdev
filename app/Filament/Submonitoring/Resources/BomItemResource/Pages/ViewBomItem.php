<?php

namespace App\Filament\Submonitoring\Resources\BomItemResource\Pages;

use App\Filament\Submonitoring\Resources\BomItemResource;
use App\viewpage;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewBomItem extends ViewRecord
{
    protected static string $resource = BomItemResource::class;

    use viewpage;
}
