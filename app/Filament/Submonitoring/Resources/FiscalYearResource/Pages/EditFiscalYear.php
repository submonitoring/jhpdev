<?php

namespace App\Filament\Submonitoring\Resources\FiscalYearResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\FiscalYearResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFiscalYear extends EditRecord
{
    protected static string $resource = FiscalYearResource::class;

    use editpage;
}
