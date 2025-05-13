<?php

namespace App\Filament\Submonitoring\Resources\JournalEntryResource\Pages;

use App\Filament\Submonitoring\Resources\JournalEntryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateJournalEntry extends CreateRecord
{
    protected static string $resource = JournalEntryResource::class;
}
