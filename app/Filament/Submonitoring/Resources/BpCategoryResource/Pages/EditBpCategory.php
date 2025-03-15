<?php

namespace App\Filament\Submonitoring\Resources\BpCategoryResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\BpCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBpCategory extends EditRecord
{
    protected static string $resource = BpCategoryResource::class;

    use editpage;
}
