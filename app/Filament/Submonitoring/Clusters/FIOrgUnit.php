<?php

namespace App\Filament\Submonitoring\Clusters;

use Filament\Clusters\Cluster;

class FIOrgUnit extends Cluster
{
    // protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?int $navigationSort = 800000000;

    protected static ?string $navigationGroup = 'Configuration';

    protected static ?string $navigationLabel = 'FI Organizational Units';
}
