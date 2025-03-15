<?php

namespace App\Filament\Submonitoring\Resources\StatusGroupResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\StatusGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStatusGroup extends EditRecord
{
    protected static string $resource = StatusGroupResource::class;

    use editpage;
}
