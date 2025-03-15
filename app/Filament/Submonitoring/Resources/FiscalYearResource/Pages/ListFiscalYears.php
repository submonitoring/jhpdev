<?php

namespace App\Filament\Submonitoring\Resources\FiscalYearResource\Pages;

use App\Filament\Submonitoring\Resources\FiscalYearResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFiscalYears extends ListRecords
{
    protected static string $resource = FiscalYearResource::class;

    use listpage;
}
