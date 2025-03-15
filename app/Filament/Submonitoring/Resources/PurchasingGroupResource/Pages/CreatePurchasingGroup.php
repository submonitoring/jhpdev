<?php

namespace App\Filament\Submonitoring\Resources\PurchasingGroupResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\PurchasingGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePurchasingGroup extends CreateRecord
{
    protected static string $resource = PurchasingGroupResource::class;

    use createpage;
}
