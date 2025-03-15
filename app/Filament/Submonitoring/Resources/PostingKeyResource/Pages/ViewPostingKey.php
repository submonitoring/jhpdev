<?php

namespace App\Filament\Submonitoring\Resources\PostingKeyResource\Pages;

use App\Filament\Submonitoring\Resources\PostingKeyResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPostingKey extends ViewRecord
{
    protected static string $resource = PostingKeyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
