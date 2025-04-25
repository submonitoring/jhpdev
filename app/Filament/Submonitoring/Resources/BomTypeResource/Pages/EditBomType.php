<?php

namespace App\Filament\Submonitoring\Resources\BomTypeResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\BomTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBomType extends EditRecord
{
    protected static string $resource = BomTypeResource::class;

    use editpage;
}
