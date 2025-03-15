<?php

namespace App\Filament\Submonitoring\Resources\BomItemResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\BomItemResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBomItem extends EditRecord
{
    protected static string $resource = BomItemResource::class;

    use editpage;
}
