<?php

namespace App\Filament\Submonitoring\Resources\ListKebutuhanProduksiResource\Pages;

use App\Filament\Submonitoring\Resources\ListKebutuhanProduksiResource;
use Asmit\ResizedColumn\HasResizableColumn;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListListKebutuhanProduksis extends ListRecords
{
    protected static string $resource = ListKebutuhanProduksiResource::class;

    use HasResizableColumn;

}
