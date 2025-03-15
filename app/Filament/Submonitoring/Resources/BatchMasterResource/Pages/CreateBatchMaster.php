<?php

namespace App\Filament\Submonitoring\Resources\BatchMasterResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\BatchMasterResource;
use App\Models\BatchSource;
use App\Models\NumberRange;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBatchMaster extends CreateRecord
{
    protected static string $resource = BatchMasterResource::class;

    use createpage;

    protected function mutateFormDataBeforeCreate(array $data): array
    {

        $getbatchsource = $this->data['batch_source_id'];

        $getnriid = BatchSource::whereId($getbatchsource)->first();

        $getcurrentnr = NumberRange::whereId($getnriid->number_range_id)->first();

        if ($getcurrentnr->is_external === 1) {

            $data['batch_number'] = $this->data['batch_number'];
            return $data;
        } else {

            if ($getcurrentnr->current_number === null) {

                $data['batch_number'] = $getcurrentnr->number;

                $updatecurrentnumber = NumberRange::whereId($getnriid->number_range_id)->first();
                $updatecurrentnumber->current_number = $data['batch_number'];
                $updatecurrentnumber->save();

                return $data;
            } else {

                $data['batch_number'] = $getcurrentnr->current_number + 1;

                $updatecurrentnumber = NumberRange::whereId($getnriid->number_range_id)->first();
                $updatecurrentnumber->current_number = $data['batch_number'];
                $updatecurrentnumber->save();

                return $data;
            }
        }
    }
}
