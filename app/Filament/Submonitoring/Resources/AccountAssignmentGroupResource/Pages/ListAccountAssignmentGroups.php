<?php

namespace App\Filament\Submonitoring\Resources\AccountAssignmentGroupResource\Pages;

use App\Filament\Submonitoring\Resources\AccountAssignmentGroupResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAccountAssignmentGroups extends ListRecords
{
    protected static string $resource = AccountAssignmentGroupResource::class;

    use listpage;
}
