<?php

namespace App\Filament\Submonitoring\Resources\MaterialMasterResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\MaterialMasterResource;
use App\Models\MaterialType;
use App\Models\NumberRange;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMaterialMaster extends CreateRecord
{
    protected static string $resource = MaterialMasterResource::class;

    use createpage;

    protected function mutateFormDataBeforeCreate(array $data): array
    {

        $getmaterialtype = $this->data['material_type_id'];

        $getnriid = MaterialType::whereId($getmaterialtype)->first();

        $getcurrentnr = NumberRange::whereId($getnriid->number_range_id)->first();

        if ($getcurrentnr->is_external === 1) {

            $data['material_number'] = $this->data['material_number'];
            return $data;
        } else {

            if ($getcurrentnr->current_number === null) {

                $data['material_number'] = $getcurrentnr->number;

                $updatecurrentnumber = Numberrange::whereId($getnriid->number_range_id)->first();
                $updatecurrentnumber->current_number = $data['material_number'];
                $updatecurrentnumber->save();

                return $data;
            } else {

                $data['material_number'] = $getcurrentnr->current_number + 1;

                $updatecurrentnumber = Numberrange::whereId($getnriid->number_range_id)->first();
                $updatecurrentnumber->current_number = $data['material_number'];
                $updatecurrentnumber->save();

                return $data;
            }
        }
    }
}
