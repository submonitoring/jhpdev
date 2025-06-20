<?php

namespace App\Filament\Submonitoring\Resources\MaterialDocumentResource\Pages;

use App\createpage;
use App\Filament\Submonitoring\Resources\MaterialDocumentResource;
use App\Models\NumberRange;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateMaterialDocument extends CreateRecord
{
    protected static string $resource = MaterialDocumentResource::class;

    use createpage;

    protected function mutateFormDataBeforeCreate(array $data): array
    {

        // dd($this->data['journalEntries']);

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

    protected function getCreateFormAction(): Action
    {
        return Action::make('create')
            ->label('Create')
            ->action(fn(CreateMaterialDocument $livewire) => $livewire->create())
            ->requiresConfirmation()
            ->modalHeading('Confirm the Material Document')
            ->modalDescription('Do you confirm that the data is correct?')
            ->modalSubmitActionLabel('Create');
    }

    // $collection = collect($livewire->data['materialDocumentItems']);

    //             $getarraykey = $collection->keys();

    //             $arraykey = $getarraykey->get(0);

    //             $journalentries = collect($livewire->data['materialDocumentItems'][$arraykey]['journalEntries']);

    //             $values = $journalentries->flatten();

    //             dd($values->values()->all());
}
