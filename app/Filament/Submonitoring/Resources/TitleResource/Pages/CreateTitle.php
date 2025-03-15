<?php

namespace App\Filament\Submonitoring\Resources\TitleResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\TitleResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTitle extends CreateRecord
{
    protected static string $resource = TitleResource::class;

    use createpage;
}
