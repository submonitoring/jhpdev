<?php

namespace App\Filament\Submonitoring\Resources\TaxClassificationResource\Pages;

use App\Filament\Submonitoring\Resources\TaxClassificationResource;
use App\viewpage;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTaxClassification extends ViewRecord
{
    protected static string $resource = TaxClassificationResource::class;

    use viewpage;
}
