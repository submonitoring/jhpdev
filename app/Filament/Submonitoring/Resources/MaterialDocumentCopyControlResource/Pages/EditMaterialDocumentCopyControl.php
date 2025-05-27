<?php

namespace App\Filament\Submonitoring\Resources\MaterialDocumentCopyControlResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\MaterialDocumentCopyControlResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMaterialDocumentCopyControl extends EditRecord
{
    protected static string $resource = MaterialDocumentCopyControlResource::class;

    use editpage;
}
