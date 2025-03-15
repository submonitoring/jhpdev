<?php

namespace App\Filament\Submonitoring\Resources\PurchasingGroupResource\Pages;

use App\Filament\Submonitoring\Resources\PurchasingGroupResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPurchasingGroups extends ListRecords
{
    protected static string $resource = PurchasingGroupResource::class;

    use listpage;
}
