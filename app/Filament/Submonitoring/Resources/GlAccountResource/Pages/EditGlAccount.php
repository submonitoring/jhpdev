<?php

namespace App\Filament\Submonitoring\Resources\GlAccountResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\GlAccountResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGlAccount extends EditRecord
{
    protected static string $resource = GlAccountResource::class;

    use editpage;
}
