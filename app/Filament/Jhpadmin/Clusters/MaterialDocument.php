<?php

namespace App\Filament\Jhpadmin\Clusters;

use Filament\Clusters\Cluster;

class MaterialDocument extends Cluster
{
    protected static ?int $navigationSort = 830000000;

    protected static ?string $navigationGroup = 'Transactions';

    protected static ?string $navigationLabel = 'Material Document';
}
