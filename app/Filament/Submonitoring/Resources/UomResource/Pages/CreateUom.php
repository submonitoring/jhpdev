<?php

namespace App\Filament\Submonitoring\Resources\UomResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\UomResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUom extends CreateRecord
{
    protected static string $resource = UomResource::class;

    use createpage;
}
