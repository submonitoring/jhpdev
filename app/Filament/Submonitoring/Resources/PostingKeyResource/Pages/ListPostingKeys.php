<?php

namespace App\Filament\Submonitoring\Resources\PostingKeyResource\Pages;

use App\Filament\Submonitoring\Resources\PostingKeyResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPostingKeys extends ListRecords
{
    protected static string $resource = PostingKeyResource::class;

    use listpage;
}
