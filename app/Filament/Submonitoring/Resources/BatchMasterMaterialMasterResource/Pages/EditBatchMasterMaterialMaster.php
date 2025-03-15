<?php

namespace App\Filament\Submonitoring\Resources\BatchMasterMaterialMasterResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\BatchMasterMaterialMasterResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBatchMasterMaterialMaster extends EditRecord
{
    protected static string $resource = BatchMasterMaterialMasterResource::class;

    use editpage;
}
