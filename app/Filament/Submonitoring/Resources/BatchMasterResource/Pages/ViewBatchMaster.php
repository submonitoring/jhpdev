<?php

namespace App\Filament\Submonitoring\Resources\BatchMasterResource\Pages;

use App\Filament\Submonitoring\Resources\BatchMasterResource;
use App\viewpage;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewBatchMaster extends ViewRecord
{
    protected static string $resource = BatchMasterResource::class;

    use viewpage;
}
