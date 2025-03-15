<?php

namespace App\Filament\Submonitoring\Resources\NrObjectResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\NrObjectResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNrObject extends EditRecord
{
    protected static string $resource = NrObjectResource::class;

    use editpage;
}
