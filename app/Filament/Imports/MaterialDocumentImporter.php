<?php

namespace App\Filament\Imports;

use App\Models\MaterialDocument;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class MaterialDocumentImporter extends Importer
{
    protected static ?string $model = MaterialDocument::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('document_date')
                ->rules(['date']),
            ImportColumn::make('transaction_type_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('transaction_reference_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('business_partner_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('document_type_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('number_range_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('document_number')
                ->rules(['max:255']),
            ImportColumn::make('text_header'),
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

    public function resolveRecord(): ?MaterialDocument
    {
        // return MaterialDocument::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new MaterialDocument();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your material document import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
