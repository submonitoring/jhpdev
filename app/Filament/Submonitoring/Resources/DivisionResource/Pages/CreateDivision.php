<?php

namespace App\Filament\Submonitoring\Resources\DivisionResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\DivisionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDivision extends CreateRecord
{
    protected static string $resource = DivisionResource::class;

    use createpage;
}
