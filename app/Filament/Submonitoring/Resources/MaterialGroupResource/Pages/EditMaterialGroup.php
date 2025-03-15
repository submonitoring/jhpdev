<?php

namespace App\Filament\Submonitoring\Resources\MaterialGroupResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\MaterialGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMaterialGroup extends EditRecord
{
    protected static string $resource = MaterialGroupResource::class;

    use editpage;
}
