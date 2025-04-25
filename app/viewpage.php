<?php

namespace App;

use App\Filament\Resources\Pages\Concerns\CanPaginateViewRecord;
use App\Filament\Submonitoring\Resources\Actions\NextAction;
use App\Filament\Submonitoring\Resources\Actions\PreviousAction;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Howdu\FilamentRecordSwitcher\Filament\Concerns\HasRecordSwitcher;
use Kenepa\ResourceLock\Resources\Pages\Concerns\UsesResourceLock;

trait viewpage
{
    protected function getHeaderActions(): array
    {
        return [
            PreviousAction::make(),
            NextAction::make(),
            EditAction::make(),
            DeleteAction::make(),
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
