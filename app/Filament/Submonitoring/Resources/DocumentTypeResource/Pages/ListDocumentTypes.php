<?php

namespace App\Filament\Submonitoring\Resources\DocumentTypeResource\Pages;

use App\Filament\Submonitoring\Resources\DocumentTypeResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDocumentTypes extends ListRecords
{
    protected static string $resource = DocumentTypeResource::class;

    use listpage;
}
