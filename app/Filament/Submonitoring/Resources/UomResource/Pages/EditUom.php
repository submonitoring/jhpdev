<?php

namespace App\Filament\Submonitoring\Resources\UomResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\UomResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUom extends EditRecord
{
    protected static string $resource = UomResource::class;

    use editpage;
}
