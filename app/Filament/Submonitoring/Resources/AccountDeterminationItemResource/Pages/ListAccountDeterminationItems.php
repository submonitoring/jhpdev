<?php

namespace App\Filament\Submonitoring\Resources\AccountDeterminationItemResource\Pages;

use App\Filament\Submonitoring\Resources\AccountDeterminationItemResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAccountDeterminationItems extends ListRecords
{
    protected static string $resource = AccountDeterminationItemResource::class;

    use listpage;
}
