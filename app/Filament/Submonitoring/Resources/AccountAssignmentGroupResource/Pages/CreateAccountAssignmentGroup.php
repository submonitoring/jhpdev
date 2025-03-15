<?php

namespace App\Filament\Submonitoring\Resources\AccountAssignmentGroupResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\AccountAssignmentGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAccountAssignmentGroup extends CreateRecord
{
    protected static string $resource = AccountAssignmentGroupResource::class;

    use createpage;
}
