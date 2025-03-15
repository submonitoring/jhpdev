<?php

namespace App\Filament\Submonitoring\Resources\DocumentTypeItemCategoryResource\Pages;

use App\Filament\Submonitoring\Resources\DocumentTypeItemCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewDocumentTypeItemCategory extends ViewRecord
{
    protected static string $resource = DocumentTypeItemCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
