<?php

namespace App\Filament\Jhp\Resources\MaterialDocumentResource\Pages;

use App\createpage;
use App\Filament\Jhp\Resources\MaterialDocumentResource;
use App\Models\NumberRange;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMaterialDocument extends CreateRecord
{
    protected static string $resource = MaterialDocumentResource::class;

    use createpage;

    protected function mutateFormDataBeforeCreate(array $data): array
    {

        $currentnriid = $this->data['number_range_id'];

        $getcurrentnr = NumberRange::whereId($currentnriid)->first();

        if ($getcurrentnr->current_number === null) {

            $data['document_number'] = $getcurrentnr->number;

            $updatecurrentnumber = NumberRange::whereId($currentnriid)->first();
            $updatecurrentnumber->current_number = $data['document_number'];
            $updatecurrentnumber->save();

            return $data;
        } else {

            $data['document_number'] = $getcurrentnr->current_number + 1;

            $updatecurrentnumber = NumberRange::whereId($currentnriid)->first();
            $updatecurrentnumber->current_number = $data['document_number'];
            $updatecurrentnumber->save();

            return $data;
        }
    }
}
