<?php

namespace App\Filament\Submonitoring\Resources\BpRoleResource\Pages;

use App\Filament\Submonitoring\Resources\BpRoleResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewBpRole extends ViewRecord
{
    protected static string $resource = BpRoleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
