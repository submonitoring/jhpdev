<?php

namespace App\Filament\Imports;

use App\Models\JournalEntry;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class JournalEntryImporter extends Importer
{
    protected static ?string $model = JournalEntry::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('sort')
                ->rules(['max:255']),
            ImportColumn::make('material_document_item_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('module_aaa_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('debit_credit_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('gl_account_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('quantity')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('amount')
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

    public function resolveRecord(): ?JournalEntry
    {
        // return JournalEntry::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new JournalEntry();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your journal entry import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
