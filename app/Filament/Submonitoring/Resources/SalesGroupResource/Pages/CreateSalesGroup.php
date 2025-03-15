<?php

namespace App\Filament\Submonitoring\Resources\SalesGroupResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\SalesGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSalesGroup extends CreateRecord
{
    protected static string $resource = SalesGroupResource::class;

    use createpage;
}
