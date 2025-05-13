<?php

namespace App\Filament\Imports;

use App\Models\AccountDetermination;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class AccountDeterminationImporter extends Importer
{
    protected static ?string $model = AccountDetermination::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('module_aaa_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('document_type_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('transaction_type_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('material_type_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('movement_type_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('unique')
                ->rules(['max:26']),
            ImportColumn::make('record_title')
                ->rules(['max:255']),
            ImportColumn::make('is_active')
                ->boolean()
                ->rules(['boolean']),
            ImportColumn::make('created_by')
                ->rules(['max:255']),
            ImportColumn::make('updated_by')
                ->rules(['max:255']),
        ];
    }

    public function resolveRecord(): ?AccountDetermination
    {
        // return AccountDetermination::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new AccountDetermination();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your account determination import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
