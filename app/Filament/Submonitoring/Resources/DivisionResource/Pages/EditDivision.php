<?php

namespace App\Filament\Submonitoring\Resources\DivisionResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\DivisionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDivision extends EditRecord
{
    protected static string $resource = DivisionResource::class;

    use editpage;
}
