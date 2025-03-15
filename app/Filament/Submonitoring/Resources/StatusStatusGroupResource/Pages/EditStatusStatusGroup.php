<?php

namespace App\Filament\Submonitoring\Resources\StatusStatusGroupResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\StatusStatusGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStatusStatusGroup extends EditRecord
{
    protected static string $resource = StatusStatusGroupResource::class;

    use editpage;
}
