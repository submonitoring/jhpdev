<?php

namespace App\Filament\Submonitoring\Resources\BatchMasterMaterialMasterResource\Pages;

use App\Filament\Submonitoring\Resources\BatchMasterMaterialMasterResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewBatchMasterMaterialMaster extends ViewRecord
{
    protected static string $resource = BatchMasterMaterialMasterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
