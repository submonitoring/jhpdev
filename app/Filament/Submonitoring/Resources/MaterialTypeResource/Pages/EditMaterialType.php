<?php

namespace App\Filament\Submonitoring\Resources\MaterialTypeResource\Pages;

use App\editpage;
use App\Filament\Resources\Pages\Concerns\CanPaginateViewRecord;
use App\Filament\Submonitoring\Resources\MaterialTypeResource;
use Awcodes\Recently\Concerns\HasRecentHistoryRecorder;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Howdu\FilamentRecordSwitcher\Filament\Concerns\HasRecordSwitcher;

class EditMaterialType extends EditRecord
{
    // use HasRecentHistoryRecorder;
    use HasRecordSwitcher;
    use CanPaginateViewRecord;

    protected static string $resource = MaterialTypeResource::class;

    use editpage;
}
