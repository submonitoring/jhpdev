<?php

namespace App\Filament\Submonitoring\Resources\AccountDeterminationResource\Pages;

use App\Filament\Submonitoring\Resources\AccountDeterminationResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAccountDeterminations extends ListRecords
{
    protected static string $resource = AccountDeterminationResource::class;

    use listpage;
}
