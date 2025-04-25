<?php

namespace App\Filament\Submonitoring\Resources\BpRoleResource\Pages;

use App\Filament\Submonitoring\Resources\BpRoleResource;
use App\viewpage;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewBpRole extends ViewRecord
{
    protected static string $resource = BpRoleResource::class;

    use viewpage;
}
