<?php

namespace App\Filament\Submonitoring\Resources\AccountDeterminationResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\AccountDeterminationResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAccountDetermination extends CreateRecord
{
    protected static string $resource = AccountDeterminationResource::class;

    use createpage;
}
