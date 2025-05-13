<?php

namespace App\Filament\Submonitoring\Resources\MaterialDocumentResource\Pages;

use App\Filament\Submonitoring\Resources\MaterialDocumentResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMaterialDocuments extends ListRecords
{
    protected static string $resource = MaterialDocumentResource::class;

    use listpage;
}
