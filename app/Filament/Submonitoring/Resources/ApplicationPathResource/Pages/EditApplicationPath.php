<?php

namespace App\Filament\Submonitoring\Resources\ApplicationPathResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\ApplicationPathResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditApplicationPath extends EditRecord
{
    protected static string $resource = ApplicationPathResource::class;

    use editpage;
}
