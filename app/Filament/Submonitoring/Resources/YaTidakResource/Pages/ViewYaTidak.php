<?php

namespace App\Filament\Submonitoring\Resources\YaTidakResource\Pages;

use App\Filament\Submonitoring\Resources\YaTidakResource;
use App\viewpage;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewYaTidak extends ViewRecord
{
    protected static string $resource = YaTidakResource::class;

    use viewpage;
}
