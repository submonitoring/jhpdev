<?php

namespace App\Filament\Submonitoring\Resources\BomHeaderResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\BomHeaderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBomHeader extends EditRecord
{
    protected static string $resource = BomHeaderResource::class;

    use editpage;
}
