<?php

namespace App\Filament\Submonitoring\Resources\PurchasingGroupResource\Pages;

use App\Filament\Submonitoring\Resources\PurchasingGroupResource;
use App\viewpage;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPurchasingGroup extends ViewRecord
{
    protected static string $resource = PurchasingGroupResource::class;

    use viewpage;
}
