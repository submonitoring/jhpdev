<?php

namespace App\Filament\Submonitoring\Resources\SalesAreaResource\Pages;

use App\Filament\Submonitoring\Resources\SalesAreaResource;
use App\viewpage;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSalesArea extends ViewRecord
{
    protected static string $resource = SalesAreaResource::class;

    use viewpage;
}
