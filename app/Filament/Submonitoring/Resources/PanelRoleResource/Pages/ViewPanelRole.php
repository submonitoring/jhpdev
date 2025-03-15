<?php

namespace App\Filament\Submonitoring\Resources\PanelRoleResource\Pages;

use App\Filament\Submonitoring\Resources\PanelRoleResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPanelRole extends ViewRecord
{
    protected static string $resource = PanelRoleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
