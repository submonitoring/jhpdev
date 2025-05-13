<?php

namespace App\Filament\Imports;

use App\Models\AccountDeterminationItem;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class AccountDeterminationItemImporter extends Importer
{
    protected static ?string $model = AccountDeterminationItem::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('sort')
                ->rules(['max:255']),
            ImportColumn::make('account_determination_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('debit_credit_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('gl_account_id')
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

    public function resolveRecord(): ?AccountDeterminationItem
    {
        // return AccountDeterminationItem::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new AccountDeterminationItem();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your account determination item import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
