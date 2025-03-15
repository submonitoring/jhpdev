<?php

namespace App\Filament\Submonitoring\Resources\DocumentTypeItemCategoryResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\DocumentTypeItemCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDocumentTypeItemCategory extends CreateRecord
{
    protected static string $resource = DocumentTypeItemCategoryResource::class;

    use createpage;
}
