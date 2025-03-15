<?php

namespace App\Filament\Submonitoring\Resources\UserResource\Pages;

use App\Filament\Submonitoring\Resources\UserResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    use listpage;
}
