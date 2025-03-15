<?php

namespace App\Filament\Submonitoring\Resources\ApplicationPathResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\ApplicationPathResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateApplicationPath extends CreateRecord
{
    protected static string $resource = ApplicationPathResource::class;

    use createpage;
}
