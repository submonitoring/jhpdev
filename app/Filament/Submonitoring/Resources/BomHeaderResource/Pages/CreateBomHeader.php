<?php

namespace App\Filament\Submonitoring\Resources\BomHeaderResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\BomHeaderResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBomHeader extends CreateRecord
{
    protected static string $resource = BomHeaderResource::class;

    use createpage;
}
