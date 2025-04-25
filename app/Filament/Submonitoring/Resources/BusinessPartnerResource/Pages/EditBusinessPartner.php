<?php

namespace App\Filament\Submonitoring\Resources\BusinessPartnerResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\BusinessPartnerResource;
use App\Models\BusinessPartnerCompany;
use App\Models\BusinessPartnerCustomer;
use App\Models\BusinessPartnerVendor;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditBusinessPartner extends EditRecord
{
    protected static string $resource = BusinessPartnerResource::class;

    protected function afterSave(): void
    {

        $record = $this->getRecord();

        // dd($record, in_array(1, $record->bp_role_id));
        $cekbpcomp = BusinessPartnerCompany::where('business_partner_id', $record->id)->pluck('id')->toArray();
        $cekbpcust = BusinessPartnerCustomer::where('business_partner_id', $record->id)->pluck('id')->toArray();
        $cekbpvend = BusinessPartnerVendor::where('business_partner_id', $record->id)->pluck('id')->toArray();

        if (!in_array(1, $record->bp_role_id) ==  true) {

            BusinessPartnerCustomer::whereIn('id', $cekbpcust)->update(['is_active' => 0]);
        }

        if (!in_array(2, $record->bp_role_id) ==  true) {

            BusinessPartnerVendor::whereIn('id', $cekbpvend)->update(['is_active' => 0]);
        }

        if (in_array(1, $record->bp_role_id) ==  true) {

            BusinessPartnerCustomer::whereIn('id', $cekbpcust)->update(['is_active' => 1]);
        }

        if (in_array(2, $record->bp_role_id) ==  true) {

            BusinessPartnerVendor::whereIn('id', $cekbpvend)->update(['is_active' => 1]);
        }

        if ($record->is_active == false) {

            BusinessPartnerCompany::whereIn('id', $cekbpcomp)->update(['is_active' => 0]);

            BusinessPartnerCustomer::whereIn('id', $cekbpcust)->update(['is_active' => 0]);

            BusinessPartnerVendor::whereIn('id', $cekbpvend)->update(['is_active' => 0]);
        }
    }

    use editpage;
}
