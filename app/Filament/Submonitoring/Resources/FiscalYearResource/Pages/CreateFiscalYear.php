<?php

namespace App\Filament\Submonitoring\Resources\FiscalYearResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\FiscalYearResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFiscalYear extends CreateRecord
{
    protected static string $resource = FiscalYearResource::class;

    use createpage;
}
