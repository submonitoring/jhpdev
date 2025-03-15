<?php

namespace App\Filament\Submonitoring\Resources\CompanyCodeResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\CompanyCodeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCompanyCode extends CreateRecord
{
    protected static string $resource = CompanyCodeResource::class;

    use createpage;
}
