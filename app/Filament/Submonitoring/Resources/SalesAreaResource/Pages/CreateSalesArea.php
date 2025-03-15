<?php

namespace App\Filament\Submonitoring\Resources\SalesAreaResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\SalesAreaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSalesArea extends CreateRecord
{
    protected static string $resource = SalesAreaResource::class;

    use createpage;
}
