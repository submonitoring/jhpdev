<?php

namespace App\Filament\Submonitoring\Resources\CompanyCodeResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\CompanyCodeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCompanyCode extends EditRecord
{
    protected static string $resource = CompanyCodeResource::class;

    use editpage;
}
