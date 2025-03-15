<?php

namespace App\Filament\Submonitoring\Resources\StatusResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\StatusResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStatus extends EditRecord
{
    protected static string $resource = StatusResource::class;

    use editpage;
}
