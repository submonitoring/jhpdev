<?php

namespace App\Filament\Submonitoring\Resources\PurchasingGroupResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\PurchasingGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPurchasingGroup extends EditRecord
{
    protected static string $resource = PurchasingGroupResource::class;

    use editpage;
}
