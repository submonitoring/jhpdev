<?php

namespace App\Filament\Submonitoring\Resources\DocumentTypeResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\DocumentTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDocumentType extends EditRecord
{
    protected static string $resource = DocumentTypeResource::class;

    use editpage;
}
