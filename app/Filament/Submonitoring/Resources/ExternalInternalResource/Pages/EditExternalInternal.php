<?php

namespace App\Filament\Submonitoring\Resources\ExternalInternalResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\ExternalInternalResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditExternalInternal extends EditRecord
{
    protected static string $resource = ExternalInternalResource::class;

    use editpage;
}
