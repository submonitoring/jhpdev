<?php

namespace App\Filament\Submonitoring\Resources\BomTypeResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\BomTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBomType extends CreateRecord
{
    protected static string $resource = BomTypeResource::class;

    use createpage;
}
