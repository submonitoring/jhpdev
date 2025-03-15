<?php

namespace App\Filament\Submonitoring\Resources\ItemCategoryResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\ItemCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditItemCategory extends EditRecord
{
    protected static string $resource = ItemCategoryResource::class;

    use editpage;
}
