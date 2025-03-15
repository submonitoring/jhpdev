<?php

namespace App\Filament\Imports;

use App\Models\MaterialMaster;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class MaterialMasterImporter extends Importer
{
    protected static ?string $model = MaterialMaster::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('number_range_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('material_number')
                ->rules(['max:255']),
            ImportColumn::make('material_type_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('industry_sector_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('material_group_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('division_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('material_desc'),
            ImportColumn::make('old_material_number')
                ->rules(['max:255']),
            ImportColumn::make('base_uom_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('weight_unit_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('gross_weight')
                ->rules(['max:255']),
            ImportColumn::make('net_weight')
                ->rules(['max:255']),
            ImportColumn::make('deletion_flag')
                ->boolean()
                ->rules(['boolean']),
            ImportColumn::make('price')
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

    public function resolveRecord(): ?MaterialMaster
    {
        // return MaterialMaster::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new MaterialMaster();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your material master import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
