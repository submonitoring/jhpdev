<?php

namespace App\Filament\Submonitoring\Resources\BusinessPartnerResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\BusinessPartnerResource;
use App\Models\NumberRange;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBusinessPartner extends CreateRecord
{
    protected static string $resource = BusinessPartnerResource::class;

    use createpage;

    protected function mutateFormDataBeforeCreate(array $data): array
    {

        $currentnriid = $this->data['number_range_id'];

        $getcurrentnr = NumberRange::whereId($currentnriid)->first();

        if ($getcurrentnr->current_number === null) {

            $data['bp_number'] = $getcurrentnr->number;

            $updatecurrentnumber = NumberRange::whereId($currentnriid)->first();
            $updatecurrentnumber->current_number = $data['bp_number'];
            $updatecurrentnumber->save();

            return $data;
        } else {

            $data['bp_number'] = $getcurrentnr->current_number + 1;

            $updatecurrentnumber = NumberRange::whereId($currentnriid)->first();
            $updatecurrentnumber->current_number = $data['bp_number'];
            $updatecurrentnumber->save();

            return $data;
        }
    }
}
