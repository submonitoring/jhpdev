<?php

namespace App\Filament\Submonitoring\Resources\TaxClassificationResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\TaxClassificationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTaxClassification extends EditRecord
{
    protected static string $resource = TaxClassificationResource::class;

    use editpage;
}
