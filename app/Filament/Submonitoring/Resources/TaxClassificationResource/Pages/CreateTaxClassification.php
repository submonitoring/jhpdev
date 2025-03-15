<?php

namespace App\Filament\Submonitoring\Resources\TaxClassificationResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\TaxClassificationResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTaxClassification extends CreateRecord
{
    protected static string $resource = TaxClassificationResource::class;

    use createpage;
}
