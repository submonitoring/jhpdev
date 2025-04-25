<?php

namespace App\Filament\Submonitoring\Resources\GlAccountResource\Pages;

use App\Filament\Submonitoring\Resources\GlAccountResource;
use App\viewpage;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewGlAccount extends ViewRecord
{
    protected static string $resource = GlAccountResource::class;

    use viewpage;
}
