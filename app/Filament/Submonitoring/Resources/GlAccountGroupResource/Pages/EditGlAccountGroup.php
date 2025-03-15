<?php

namespace App\Filament\Submonitoring\Resources\GlAccountGroupResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\GlAccountGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGlAccountGroup extends EditRecord
{
    protected static string $resource = GlAccountGroupResource::class;

    use editpage;
}
