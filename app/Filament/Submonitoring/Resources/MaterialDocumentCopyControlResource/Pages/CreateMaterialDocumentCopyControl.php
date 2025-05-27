<?php

namespace App\Filament\Submonitoring\Resources\MaterialDocumentCopyControlResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\MaterialDocumentCopyControlResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMaterialDocumentCopyControl extends CreateRecord
{
    protected static string $resource = MaterialDocumentCopyControlResource::class;

    use createpage;
}
