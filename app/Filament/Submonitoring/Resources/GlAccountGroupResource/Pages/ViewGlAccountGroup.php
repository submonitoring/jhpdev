<?php

namespace App\Filament\Submonitoring\Resources\GlAccountGroupResource\Pages;

use App\Filament\Submonitoring\Resources\GlAccountGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewGlAccountGroup extends ViewRecord
{
    protected static string $resource = GlAccountGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
