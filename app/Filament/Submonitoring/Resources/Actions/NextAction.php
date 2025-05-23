<?php

//app/Filament/Resources/Actions/NextAction.php

namespace App\Filament\Submonitoring\Resources\Actions;

use Filament\Actions\Action;

class NextAction extends Action
{
    public static function getDefaultName(): ?string
    {
        return 'next';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->hiddenLabel()
            ->icon('heroicon-o-arrow-right')
            ->outlined()
            ->tooltip("Next of {$this->getRecordTitle()}");
    }
}
