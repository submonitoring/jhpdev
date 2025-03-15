<?php

namespace App\Filament\Submonitoring\Resources\TaxClassificationResource\Pages;

use App\Filament\Submonitoring\Resources\TaxClassificationResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTaxClassifications extends ListRecords
{
    protected static string $resource = TaxClassificationResource::class;

    use listpage;
}
