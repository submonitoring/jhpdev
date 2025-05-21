<?php

namespace App;

use Asmit\ResizedColumn\HasResizableColumn;
use LaraZeus\Delia\Filament\Actions\BookmarkHeaderAction;

trait listpage
{

    use HasResizableColumn;
    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
            // BookmarkHeaderAction::make(),
        ];
    }
}
