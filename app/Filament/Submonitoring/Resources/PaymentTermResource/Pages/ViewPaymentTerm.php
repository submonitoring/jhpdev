<?php

namespace App\Filament\Submonitoring\Resources\PaymentTermResource\Pages;

use App\Filament\Submonitoring\Resources\PaymentTermResource;
use App\viewpage;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPaymentTerm extends ViewRecord
{
    protected static string $resource = PaymentTermResource::class;

    use viewpage;
}
