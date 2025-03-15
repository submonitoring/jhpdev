<?php

namespace App\Filament\Submonitoring\Resources\MaterialMasterResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\MaterialMasterResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMaterialMaster extends EditRecord
{
    protected static string $resource = MaterialMasterResource::class;

    use editpage;
}
