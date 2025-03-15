<?php

namespace App\Filament\Submonitoring\Resources\DocumentTypeItemCategoryResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\DocumentTypeItemCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDocumentTypeItemCategory extends EditRecord
{
    protected static string $resource = DocumentTypeItemCategoryResource::class;

    use editpage;
}
