<?php

namespace App\Filament\Submonitoring\Resources\IndustrySectorResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\IndustrySectorResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIndustrySector extends EditRecord
{
    protected static string $resource = IndustrySectorResource::class;

    use editpage;
}
