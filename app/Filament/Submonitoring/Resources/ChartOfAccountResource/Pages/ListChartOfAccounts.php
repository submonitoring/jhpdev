<?php

namespace App\Filament\Submonitoring\Resources\ChartOfAccountResource\Pages;

use App\Filament\Submonitoring\Resources\ChartOfAccountResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListChartOfAccounts extends ListRecords
{
    protected static string $resource = ChartOfAccountResource::class;

    use listpage;
}
