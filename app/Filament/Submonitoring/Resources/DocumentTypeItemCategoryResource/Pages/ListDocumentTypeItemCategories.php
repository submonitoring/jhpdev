<?php

namespace App\Filament\Submonitoring\Resources\DocumentTypeItemCategoryResource\Pages;

use App\Filament\Submonitoring\Resources\DocumentTypeItemCategoryResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDocumentTypeItemCategories extends ListRecords
{
    protected static string $resource = DocumentTypeItemCategoryResource::class;

    use listpage;
}
