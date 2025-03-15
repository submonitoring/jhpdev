<?php

namespace App\Filament\Submonitoring\Resources\BatchSourceResource\Pages;

use App\Filament\Submonitoring\Resources\BatchSourceResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBatchSources extends ListRecords
{
    protected static string $resource = BatchSourceResource::class;

    use listpage;
}
