<?php

namespace App\Filament\Jhpadmin\Resources\MaterialDocumentResource\Pages;

use App\Filament\Jhpadmin\Resources\MaterialDocumentResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMaterialDocuments extends ListRecords
{
    protected static string $resource = MaterialDocumentResource::class;

    use listpage;
}
