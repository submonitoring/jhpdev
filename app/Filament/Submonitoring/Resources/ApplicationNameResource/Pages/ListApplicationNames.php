<?php

namespace App\Filament\Submonitoring\Resources\ApplicationNameResource\Pages;

use App\Filament\Submonitoring\Resources\ApplicationNameResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListApplicationNames extends ListRecords
{
    protected static string $resource = ApplicationNameResource::class;

    use listpage;
}
