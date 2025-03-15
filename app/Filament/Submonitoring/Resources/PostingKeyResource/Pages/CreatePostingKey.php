<?php

namespace App\Filament\Submonitoring\Resources\PostingKeyResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\PostingKeyResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePostingKey extends CreateRecord
{
    protected static string $resource = PostingKeyResource::class;

    use createpage;
}
