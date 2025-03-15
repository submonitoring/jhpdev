<?php

namespace App\Filament\Submonitoring\Resources\BpCategoryResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\BpCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBpCategory extends CreateRecord
{
    protected static string $resource = BpCategoryResource::class;

    use createpage;
}
