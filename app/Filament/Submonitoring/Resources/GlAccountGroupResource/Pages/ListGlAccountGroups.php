<?php

namespace App\Filament\Submonitoring\Resources\GlAccountGroupResource\Pages;

use App\Filament\Submonitoring\Resources\GlAccountGroupResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGlAccountGroups extends ListRecords
{
    protected static string $resource = GlAccountGroupResource::class;

    use listpage;
}
