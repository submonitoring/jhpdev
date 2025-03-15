<?php

namespace App\Filament\Submonitoring\Resources\DebitCreditResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\DebitCreditResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDebitCredit extends CreateRecord
{
    protected static string $resource = DebitCreditResource::class;

    use createpage;
}
