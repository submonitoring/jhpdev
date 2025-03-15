<?php

namespace App\Filament\Submonitoring\Resources\GlAccountResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\GlAccountResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateGlAccount extends CreateRecord
{
    protected static string $resource = GlAccountResource::class;

    use createpage;
}
