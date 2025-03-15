<?php

namespace App\Filament\Submonitoring\Resources\SalesGroupResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\SalesGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSalesGroup extends EditRecord
{
    protected static string $resource = SalesGroupResource::class;

    use editpage;
}
