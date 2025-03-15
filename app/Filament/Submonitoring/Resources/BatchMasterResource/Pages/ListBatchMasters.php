<?php

namespace App\Filament\Submonitoring\Resources\BatchMasterResource\Pages;

use App\Filament\Submonitoring\Resources\BatchMasterResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBatchMasters extends ListRecords
{
    protected static string $resource = BatchMasterResource::class;

    use listpage;
}
