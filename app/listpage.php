<?php

namespace App;

use LaraZeus\Delia\Filament\Actions\BookmarkHeaderAction;

trait listpage
{
    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
            BookmarkHeaderAction::make(),
        ];
    }
}
