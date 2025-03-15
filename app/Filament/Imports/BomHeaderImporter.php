<?php

namespace App\Filament\Imports;

use App\Models\BomHeader;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class BomHeaderImporter extends Importer
{
    protected static ?string $model = BomHeader::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('material_master_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('bom_header_text'),
            ImportColumn::make('quantity')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('uom_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('is_active')
                ->boolean()
                ->rules(['boolean']),
            ImportColumn::make('created_by')
                ->rules(['max:255']),
            ImportColumn::make('updated_by')
                ->rules(['max:255']),
        ];
    }

    public function resolveRecord(): ?BomHeader
    {
        // return BomHeader::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new BomHeader();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your bom header import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
