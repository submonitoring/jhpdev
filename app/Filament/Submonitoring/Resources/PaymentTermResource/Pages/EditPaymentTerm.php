<?php

namespace App\Filament\Submonitoring\Resources\PaymentTermResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\PaymentTermResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPaymentTerm extends EditRecord
{
    protected static string $resource = PaymentTermResource::class;

    use editpage;
}
