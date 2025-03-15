<?php

namespace App\Filament\Submonitoring\Resources\BomItemResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\BomItemResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBomItem extends CreateRecord
{
    protected static string $resource = BomItemResource::class;

    use createpage;
}
