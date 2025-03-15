<?php

namespace App\Filament\Submonitoring\Resources\BatchMasterResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\BatchMasterResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBatchMaster extends EditRecord
{
    protected static string $resource = BatchMasterResource::class;

    use editpage;
}
