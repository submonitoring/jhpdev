<?php

namespace App\Filament\Submonitoring\Resources\BatchSourceResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\BatchSourceResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBatchSource extends CreateRecord
{
    protected static string $resource = BatchSourceResource::class;

    use createpage;
}
