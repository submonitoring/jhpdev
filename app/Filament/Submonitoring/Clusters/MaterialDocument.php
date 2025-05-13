<?php

namespace App\Filament\Submonitoring\Clusters;

use Filament\Clusters\Cluster;

class MaterialDocument extends Cluster
{
    // protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?int $navigationSort = 830000000;

    protected static ?string $navigationGroup = 'Transactions';

    protected static ?string $navigationLabel = 'Material Document';
}
