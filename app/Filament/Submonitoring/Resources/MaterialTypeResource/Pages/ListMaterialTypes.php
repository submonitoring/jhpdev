<?php

namespace App\Filament\Submonitoring\Resources\MaterialTypeResource\Pages;

use App\Filament\Submonitoring\Resources\MaterialTypeResource;
use App\listpage;
use AymanAlhattami\FilamentContextMenu\Traits\PageHasContextMenu;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;

class ListMaterialTypes extends ListRecords
{

    protected static string $resource = MaterialTypeResource::class;

    use listpage;
}
