<?php

namespace App\Filament\Submonitoring\Resources\YaTidakResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\YaTidakResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditYaTidak extends EditRecord
{
    protected static string $resource = YaTidakResource::class;

    use editpage;
}
