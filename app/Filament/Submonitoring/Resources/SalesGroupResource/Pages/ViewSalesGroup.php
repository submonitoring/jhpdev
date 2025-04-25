<?php

namespace App\Filament\Submonitoring\Resources\SalesGroupResource\Pages;

use App\Filament\Submonitoring\Resources\SalesGroupResource;
use App\viewpage;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSalesGroup extends ViewRecord
{
    protected static string $resource = SalesGroupResource::class;

    use viewpage;
}
