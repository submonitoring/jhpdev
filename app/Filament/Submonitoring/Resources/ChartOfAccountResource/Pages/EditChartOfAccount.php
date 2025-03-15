<?php

namespace App\Filament\Submonitoring\Resources\ChartOfAccountResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\ChartOfAccountResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditChartOfAccount extends EditRecord
{
    protected static string $resource = ChartOfAccountResource::class;

    use editpage;
}
