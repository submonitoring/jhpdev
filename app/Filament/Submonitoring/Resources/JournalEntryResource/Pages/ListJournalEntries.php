<?php

namespace App\Filament\Submonitoring\Resources\JournalEntryResource\Pages;

use App\Filament\Submonitoring\Resources\JournalEntryResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJournalEntries extends ListRecords
{
    protected static string $resource = JournalEntryResource::class;

    use listpage;

}
