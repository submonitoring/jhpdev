<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;

class MaterialMasterSales extends Model
{
    public function materialMaster()
    {
        return $this->belongsTo(MaterialMaster::class);
    }

    public function salesOrganization()
    {
        return $this->belongsTo(SalesOrganization::class);
    }

    public function distributionChannel()
    {
        return $this->belongsTo(DistributionChannel::class);
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function accountAssignmentGroup()
    {
        return $this->belongsTo(AccountAssignmentGroup::class);
    }

    public function taxClassification()
    {
        return $this->belongsTo(TaxClassification::class);
    }

    public function plant()
    {
        return $this->belongsTo(Plant::class);
    }

    public function materialGroup()
    {
        return $this->belongsTo(MaterialGroup::class);
    }

    use log;
}
