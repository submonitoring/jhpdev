<?php

namespace App\Filament\Submonitoring\Resources\MaterialDocumentItemResource\Pages;

use App\Filament\Resources\Pages\Concerns\CanPaginateViewRecord;
use App\Filament\Submonitoring\Resources\Actions\NextAction;
use App\Filament\Submonitoring\Resources\Actions\PreviousAction;
use App\Filament\Submonitoring\Resources\MaterialDocumentItemResource;
use App\viewpage;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Howdu\FilamentRecordSwitcher\Filament\Concerns\HasRecordSwitcher;

class ViewMaterialDocumentItem extends ViewRecord
{
    protected static string $resource = MaterialDocumentItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            PreviousAction::make(),
            NextAction::make(),
            EditAction::make(),
            // DeleteAction::make(),
            Action::make('Back to List')
                ->url($this->getResource()::getUrl('index')),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    use HasRecordSwitcher;
    use CanPaginateViewRecord;
}
