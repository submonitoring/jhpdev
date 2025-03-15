<?php

namespace App\Filament\Submonitoring\Resources\SalesOrganizationResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\SalesOrganizationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSalesOrganization extends EditRecord
{
    protected static string $resource = SalesOrganizationResource::class;

    use editpage;
}
