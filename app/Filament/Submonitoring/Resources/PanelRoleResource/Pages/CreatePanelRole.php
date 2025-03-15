<?php

namespace App\Filament\Submonitoring\Resources\PanelRoleResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\PanelRoleResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePanelRole extends CreateRecord
{
    protected static string $resource = PanelRoleResource::class;

    use createpage;
}
