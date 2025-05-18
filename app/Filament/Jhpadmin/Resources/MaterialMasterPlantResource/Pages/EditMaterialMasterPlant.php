<?php

namespace App\Filament\Jhpadmin\Resources\MaterialMasterPlantResource\Pages;

use App\Filament\Jhpadmin\Resources\MaterialMasterPlantResource;
use App\Filament\Resources\Pages\Concerns\CanPaginateViewRecord;
use App\Filament\Submonitoring\Resources\Actions\NextAction;
use App\Filament\Submonitoring\Resources\Actions\PreviousAction;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Howdu\FilamentRecordSwitcher\Filament\Concerns\HasRecordSwitcher;
use Kenepa\ResourceLock\Resources\Pages\Concerns\UsesResourceLock;

class EditMaterialMasterPlant extends EditRecord
{
    protected static string $resource = MaterialMasterPlantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            PreviousAction::make(),
            NextAction::make(),
            ViewAction::make(),
            // DeleteAction::make(),
            Action::make('Back to List')
                ->url($this->getResource()::getUrl('index')),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    use UsesResourceLock;
    use HasRecordSwitcher;
    use CanPaginateViewRecord;
}
