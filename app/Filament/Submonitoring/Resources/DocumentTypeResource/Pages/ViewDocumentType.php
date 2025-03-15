<?php

namespace App\Filament\Submonitoring\Resources\DocumentTypeResource\Pages;

use App\Filament\Submonitoring\Resources\DocumentTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewDocumentType extends ViewRecord
{
    protected static string $resource = DocumentTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
