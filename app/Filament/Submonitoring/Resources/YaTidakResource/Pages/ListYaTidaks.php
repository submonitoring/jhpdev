<?php

namespace App\Filament\Submonitoring\Resources\YaTidakResource\Pages;

use App\Filament\Submonitoring\Resources\YaTidakResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListYaTidaks extends ListRecords
{
    protected static string $resource = YaTidakResource::class;

    use listpage;
}
