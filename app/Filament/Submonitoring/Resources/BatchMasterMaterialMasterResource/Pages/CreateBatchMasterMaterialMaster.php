<?php

namespace App\Filament\Submonitoring\Resources\BatchMasterMaterialMasterResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\BatchMasterMaterialMasterResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBatchMasterMaterialMaster extends CreateRecord
{
    protected static string $resource = BatchMasterMaterialMasterResource::class;

    use createpage;
}
