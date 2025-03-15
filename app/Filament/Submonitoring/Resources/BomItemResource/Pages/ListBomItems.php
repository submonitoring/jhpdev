<?php

namespace App\Filament\Submonitoring\Resources\BomItemResource\Pages;

use App\Filament\Submonitoring\Resources\BomItemResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBomItems extends ListRecords
{
    protected static string $resource = BomItemResource::class;

    use listpage;
}
