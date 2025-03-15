<?php

namespace App\Filament\Submonitoring\Resources\TitleResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\TitleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTitle extends EditRecord
{
    protected static string $resource = TitleResource::class;

    use editpage;
}
