<?php

namespace App\Filament\Submonitoring\Resources\BusinessPartnerResource\Pages;

use App\Filament\Submonitoring\Resources\BusinessPartnerResource;
use App\listpage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBusinessPartners extends ListRecords
{
    protected static string $resource = BusinessPartnerResource::class;

    use listpage;
}
