<?php

namespace App\Filament\Submonitoring\Resources\PanelRoleResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\PanelRoleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPanelRole extends EditRecord
{
    protected static string $resource = PanelRoleResource::class;

    use editpage;
}
