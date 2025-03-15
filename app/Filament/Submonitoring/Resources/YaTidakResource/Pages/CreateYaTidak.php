<?php

namespace App\Filament\Submonitoring\Resources\YaTidakResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\YaTidakResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateYaTidak extends CreateRecord
{
    protected static string $resource = YaTidakResource::class;

    use createpage;
}
