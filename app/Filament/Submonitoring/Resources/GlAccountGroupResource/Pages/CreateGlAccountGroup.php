<?php

namespace App\Filament\Submonitoring\Resources\GlAccountGroupResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\GlAccountGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateGlAccountGroup extends CreateRecord
{
    protected static string $resource = GlAccountGroupResource::class;

    use createpage;
}
