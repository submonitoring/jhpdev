<?php

namespace App\Filament\Submonitoring\Resources\UserResource\Pages;

use App\editpage;
use App\Filament\Submonitoring\Resources\UserResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Kenepa\ResourceLock\Resources\Pages\Concerns\UsesResourceLock;
use STS\FilamentImpersonate\Pages\Actions\Impersonate;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getActions(): array
    {
        return [
            Impersonate::make()->record($this->getRecord()) // <--
        ];
    }

    // protected function BeforeSave(array $data): array
    // {
    //     $data['jhpunique'] = $data['password'];

    //     return $data;
    // }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $data['password'] = $data['jhpunique'];
        $record->update($data);

        return $record;
    }
}
