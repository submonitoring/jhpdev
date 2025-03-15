<?php

namespace App\Filament\Submonitoring\Resources\CompanyCodeResource\Pages;

use App\Filament\Submonitoring\Resources\CompanyCodeResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCompanyCodes extends ListRecords
{
    protected static string $resource = CompanyCodeResource::class;

    use listpage;
}
