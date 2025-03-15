<?php

namespace App\Filament\Submonitoring\Resources\DebitCreditResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\DebitCreditResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDebitCredit extends EditRecord
{
    protected static string $resource = DebitCreditResource::class;

    use editpage;
}
