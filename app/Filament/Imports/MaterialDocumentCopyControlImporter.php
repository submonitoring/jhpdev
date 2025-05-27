<?php

namespace App\Filament\Imports;

use App\Models\MaterialDocumentCopyControl;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class MaterialDocumentCopyControlImporter extends Importer
{
    protected static ?string $model = MaterialDocumentCopyControl::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('transaction_type_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('transaction_reference_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('reference_transaction_reference_id')
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

    public function resolveRecord(): ?MaterialDocumentCopyControl
    {
        // return MaterialDocumentCopyControl::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new MaterialDocumentCopyControl();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your material document copy control import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
