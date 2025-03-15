<?php

namespace App\Filament\Submonitoring\Resources\StatusResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\StatusResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateStatus extends CreateRecord
{
    protected static string $resource = StatusResource::class;

    use createpage;
}
