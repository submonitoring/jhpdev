<?php

namespace App\Filament\Submonitoring\Resources\BpCategoryResource\Pages;

use App\Filament\Submonitoring\Resources\BpCategoryResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBpCategories extends ListRecords
{
    protected static string $resource = BpCategoryResource::class;

    use listpage;
}
