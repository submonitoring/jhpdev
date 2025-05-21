<?php

namespace App\Filament\Jhp\Resources\ListKebutuhanProduksiResource\Pages;

use App\Filament\Jhp\Resources\ListKebutuhanProduksiResource;
use Asmit\ResizedColumn\HasResizableColumn;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListListKebutuhanProduksis extends ListRecords
{
    protected static string $resource = ListKebutuhanProduksiResource::class;

    use HasResizableColumn;
}
