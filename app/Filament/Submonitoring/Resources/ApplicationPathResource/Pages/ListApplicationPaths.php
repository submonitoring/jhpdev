<?php

namespace App\Filament\Submonitoring\Resources\ApplicationPathResource\Pages;

use App\Filament\Submonitoring\Resources\ApplicationPathResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListApplicationPaths extends ListRecords
{
    protected static string $resource = ApplicationPathResource::class;

    use listpage;
}
