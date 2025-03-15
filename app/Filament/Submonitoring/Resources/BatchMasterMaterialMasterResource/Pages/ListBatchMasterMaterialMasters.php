<?php

namespace App\Filament\Submonitoring\Resources\BatchMasterMaterialMasterResource\Pages;

use App\Filament\Submonitoring\Resources\BatchMasterMaterialMasterResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBatchMasterMaterialMasters extends ListRecords
{
    protected static string $resource = BatchMasterMaterialMasterResource::class;

    use listpage;
}
