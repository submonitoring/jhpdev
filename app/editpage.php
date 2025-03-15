<?php

namespace App;

use App\Filament\Submonitoring\Resources\Actions\NextAction;
use App\Filament\Submonitoring\Resources\Actions\PreviousAction;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Kenepa\ResourceLock\Resources\Pages\Concerns\UsesResourceLock;

trait editpage
{
    protected function getHeaderActions(): array
    {
        return [
            PreviousAction::make(),
            NextAction::make(),
            ViewAction::make(),
            DeleteAction::make(),
            Action::make('Back to List')
                ->url($this->getResource()::getUrl('index')),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    use UsesResourceLock;
}
