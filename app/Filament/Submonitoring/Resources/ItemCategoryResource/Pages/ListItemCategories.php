<?php

namespace App\Filament\Submonitoring\Resources\ItemCategoryResource\Pages;

use App\Filament\Submonitoring\Resources\ItemCategoryResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListItemCategories extends ListRecords
{
    protected static string $resource = ItemCategoryResource::class;

    use listpage;
}
