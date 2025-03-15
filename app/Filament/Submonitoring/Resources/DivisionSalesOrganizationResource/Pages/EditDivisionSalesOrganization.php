<?php

namespace App\Filament\Submonitoring\Resources\DivisionSalesOrganizationResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\DivisionSalesOrganizationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDivisionSalesOrganization extends EditRecord
{
    protected static string $resource = DivisionSalesOrganizationResource::class;

    use editpage;
}
