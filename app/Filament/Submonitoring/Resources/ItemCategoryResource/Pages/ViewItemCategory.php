<?php

namespace App\Filament\Submonitoring\Resources\ItemCategoryResource\Pages;

use App\Filament\Submonitoring\Resources\ItemCategoryResource;
use App\viewpage;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewItemCategory extends ViewRecord
{
    protected static string $resource = ItemCategoryResource::class;

    use viewpage;
}
