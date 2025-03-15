<?php

namespace App\Filament\Submonitoring\Resources\PanelRoleResource\Pages;

use App\Filament\Submonitoring\Resources\PanelRoleResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPanelRoles extends ListRecords
{
    protected static string $resource = PanelRoleResource::class;

    use listpage;
}
