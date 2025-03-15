<?php

namespace App\Filament\Submonitoring\Resources\AccountAssignmentGroupResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\AccountAssignmentGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAccountAssignmentGroup extends EditRecord
{
    protected static string $resource = AccountAssignmentGroupResource::class;

    use editpage;
}
