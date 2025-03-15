<?php

namespace App\Filament\Submonitoring\Resources\ClientResource\Pages;

use App\Filament\Submonitoring\Resources\ClientResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListClients extends ListRecords
{
    protected static string $resource = ClientResource::class;

    use listpage;
}
