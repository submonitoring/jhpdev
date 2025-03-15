<?php

namespace App\Filament\Submonitoring\Resources\IndustrySectorResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\IndustrySectorResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateIndustrySector extends CreateRecord
{
    protected static string $resource = IndustrySectorResource::class;

    use createpage;
}
