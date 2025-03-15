<?php

namespace App\Filament\Submonitoring\Resources\TitleResource\Pages;

use App\Filament\Submonitoring\Resources\TitleResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTitles extends ListRecords
{
    protected static string $resource = TitleResource::class;

    use listpage;
}
