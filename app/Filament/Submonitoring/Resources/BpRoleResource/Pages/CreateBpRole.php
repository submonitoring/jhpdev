<?php

namespace App\Filament\Submonitoring\Resources\BpRoleResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\BpRoleResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBpRole extends CreateRecord
{
    protected static string $resource = BpRoleResource::class;

    use createpage;
}
