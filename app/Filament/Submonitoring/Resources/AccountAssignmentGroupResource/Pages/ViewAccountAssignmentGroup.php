<?php

namespace App\Filament\Submonitoring\Resources\AccountAssignmentGroupResource\Pages;

use App\Filament\Submonitoring\Resources\AccountAssignmentGroupResource;
use App\viewpage;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAccountAssignmentGroup extends ViewRecord
{
    protected static string $resource = AccountAssignmentGroupResource::class;

    use viewpage;
}
