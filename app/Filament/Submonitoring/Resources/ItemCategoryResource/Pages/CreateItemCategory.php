<?php

namespace App\Filament\Submonitoring\Resources\ItemCategoryResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\ItemCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateItemCategory extends CreateRecord
{
    protected static string $resource = ItemCategoryResource::class;

    use createpage;
}
