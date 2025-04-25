<?php

namespace App\Filament\Submonitoring\Resources\StatusGroupResource\Pages;

use App\Filament\Submonitoring\Resources\StatusGroupResource;
use App\viewpage;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewStatusGroup extends ViewRecord
{
    protected static string $resource = StatusGroupResource::class;

    use viewpage;
}
