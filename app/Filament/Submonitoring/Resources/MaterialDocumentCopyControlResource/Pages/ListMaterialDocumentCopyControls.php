<?php

namespace App\Filament\Submonitoring\Resources\MaterialDocumentCopyControlResource\Pages;

use App\Filament\Submonitoring\Resources\MaterialDocumentCopyControlResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMaterialDocumentCopyControls extends ListRecords
{
    protected static string $resource = MaterialDocumentCopyControlResource::class;

    use listpage;
}
