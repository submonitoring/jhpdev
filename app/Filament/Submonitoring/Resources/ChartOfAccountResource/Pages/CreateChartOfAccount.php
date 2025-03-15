<?php

namespace App\Filament\Submonitoring\Resources\ChartOfAccountResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\ChartOfAccountResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateChartOfAccount extends CreateRecord
{
    protected static string $resource = ChartOfAccountResource::class;

    use createpage;
}
