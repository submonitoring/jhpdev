<?php

namespace App\Filament\Submonitoring\Resources\PaymentTermResource\Pages;

use App\Filament\Submonitoring\Resources\PaymentTermResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPaymentTerms extends ListRecords
{
    protected static string $resource = PaymentTermResource::class;

    use listpage;
}
