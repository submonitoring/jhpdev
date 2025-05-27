<?php

namespace App\Filament\Submonitoring\Resources\MaterialDocumentCopyControlResource\Pages;

use App\Filament\Submonitoring\Resources\MaterialDocumentCopyControlResource;
use App\viewpage;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMaterialDocumentCopyControl extends ViewRecord
{
    protected static string $resource = MaterialDocumentCopyControlResource::class;

    use viewpage;
}
