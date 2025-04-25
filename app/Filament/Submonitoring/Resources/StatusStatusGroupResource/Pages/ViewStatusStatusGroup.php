<?php

namespace App\Filament\Submonitoring\Resources\StatusStatusGroupResource\Pages;

use App\Filament\Submonitoring\Resources\StatusStatusGroupResource;
use App\viewpage;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewStatusStatusGroup extends ViewRecord
{
    protected static string $resource = StatusStatusGroupResource::class;

    use viewpage;

    public static function shouldRegisterSpotlight(): bool
    {
        return false;
    }
}
