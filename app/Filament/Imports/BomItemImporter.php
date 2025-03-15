<?php

namespace App\Filament\Imports;

use App\Models\BomItem;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class BomItemImporter extends Importer
{
    protected static ?string $model = BomItem::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('sort')
                ->rules(['max:255']),
            ImportColumn::make('bom_header_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('material_master_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('bom_item_text'),
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

    public function resolveRecord(): ?BomItem
    {
        // return BomItem::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new BomItem();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your bom item import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
