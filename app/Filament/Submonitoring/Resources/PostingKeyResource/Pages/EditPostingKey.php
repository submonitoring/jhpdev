<?php

namespace App\Filament\Submonitoring\Resources\PostingKeyResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\PostingKeyResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPostingKey extends EditRecord
{
    protected static string $resource = PostingKeyResource::class;

    use editpage;
}
