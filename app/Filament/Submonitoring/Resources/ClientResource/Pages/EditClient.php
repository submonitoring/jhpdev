<?php

namespace App\Filament\Submonitoring\Resources\ClientResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\ClientResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditClient extends EditRecord
{
    protected static string $resource = ClientResource::class;

    use editpage;
}
