<?php

namespace App\Filament\Submonitoring\Resources\SalesAreaResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\SalesAreaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSalesArea extends EditRecord
{
    protected static string $resource = SalesAreaResource::class;

    use editpage;
}
