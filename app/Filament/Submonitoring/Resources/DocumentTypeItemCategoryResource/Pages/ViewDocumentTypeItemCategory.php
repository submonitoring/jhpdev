<?php

namespace App\Filament\Submonitoring\Resources\DocumentTypeItemCategoryResource\Pages;

use App\Filament\Submonitoring\Resources\DocumentTypeItemCategoryResource;
use App\viewpage;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewDocumentTypeItemCategory extends ViewRecord
{
    protected static string $resource = DocumentTypeItemCategoryResource::class;

    use viewpage;
}
