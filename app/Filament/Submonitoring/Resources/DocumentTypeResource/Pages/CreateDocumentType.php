<?php

namespace App\Filament\Submonitoring\Resources\DocumentTypeResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\DocumentTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDocumentType extends CreateRecord
{
    protected static string $resource = DocumentTypeResource::class;

    use createpage;
}
