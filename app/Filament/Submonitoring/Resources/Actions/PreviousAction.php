<?php

namespace App\Filament\Submonitoring\Resources\Actions;

use Filament\Actions\Action;

class PreviousAction extends Action
{
    public static function getDefaultName(): ?string
    {
        return 'previous';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->hiddenLabel()
            ->icon('heroicon-o-arrow-left')
            ->outlined()
            ->tooltip("Previous of {$this->getRecordTitle()}");
    }
}
