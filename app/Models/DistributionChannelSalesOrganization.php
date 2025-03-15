<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;

class DistributionChannelSalesOrganization extends Model
{
    protected $table = 'distribution_channel_sales_organization';

    public function distributionChannel()
    {
        return $this->belongsTo(DistributionChannel::class);
    }

    public function salesOrganization()
    {
        return $this->belongsTo(SalesOrganization::class);
    }

    use log;
}
