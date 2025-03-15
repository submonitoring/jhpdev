<?php

namespace App\Filament\Submonitoring\Resources\StatusStatusGroupResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\StatusStatusGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateStatusStatusGroup extends CreateRecord
{
    protected static string $resource = StatusStatusGroupResource::class;

    use createpage;
}
