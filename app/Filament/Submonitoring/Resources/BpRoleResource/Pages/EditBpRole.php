<?php

namespace App\Filament\Submonitoring\Resources\BpRoleResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\BpRoleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBpRole extends EditRecord
{
    protected static string $resource = BpRoleResource::class;

    use editpage;
}
