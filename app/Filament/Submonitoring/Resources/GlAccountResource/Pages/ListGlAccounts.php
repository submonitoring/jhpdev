<?php

namespace App\Filament\Submonitoring\Resources\GlAccountResource\Pages;

use App\Filament\Submonitoring\Resources\GlAccountResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGlAccounts extends ListRecords
{
    protected static string $resource = GlAccountResource::class;

    use listpage;
}
