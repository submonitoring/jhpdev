<?php

namespace App\Filament\Submonitoring\Resources\PaymentTermResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\PaymentTermResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePaymentTerm extends CreateRecord
{
    protected static string $resource = PaymentTermResource::class;

    use createpage;
}
