<?php

namespace App\Filament\Submonitoring\Resources\FiscalYearResource\Pages;

use App\Filament\Submonitoring\Resources\FiscalYearResource;
use App\viewpage;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewFiscalYear extends ViewRecord
{
    protected static string $resource = FiscalYearResource::class;

    use viewpage;
}
