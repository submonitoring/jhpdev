<?php

namespace App\Filament\Submonitoring\Resources\BpCategoryResource\Pages;

use App\Filament\Submonitoring\Resources\BpCategoryResource;
use App\viewpage;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewBpCategory extends ViewRecord
{
    protected static string $resource = BpCategoryResource::class;

    use viewpage;
}
