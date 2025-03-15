<?php

namespace App\Filament\Submonitoring\Resources\BatchSourceResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\BatchSourceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBatchSource extends EditRecord
{
    protected static string $resource = BatchSourceResource::class;

    use editpage;
}
