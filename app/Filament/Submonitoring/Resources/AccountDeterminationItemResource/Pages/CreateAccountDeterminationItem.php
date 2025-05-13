<?php

namespace App\Filament\Submonitoring\Resources\AccountDeterminationItemResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\AccountDeterminationItemResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAccountDeterminationItem extends CreateRecord
{
    protected static string $resource = AccountDeterminationItemResource::class;

    use createpage;
}
