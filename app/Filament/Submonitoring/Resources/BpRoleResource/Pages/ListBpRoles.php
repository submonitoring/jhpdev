<?php

namespace App\Filament\Submonitoring\Resources\BpRoleResource\Pages;

use App\Filament\Submonitoring\Resources\BpRoleResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBpRoles extends ListRecords
{
    protected static string $resource = BpRoleResource::class;

    use listpage;
}
