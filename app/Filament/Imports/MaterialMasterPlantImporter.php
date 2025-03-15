<?php

namespace App\Filament\Imports;

use App\Models\MaterialMasterPlant;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class MaterialMasterPlantImporter extends Importer
{
    protected static ?string $model = MaterialMasterPlant::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('material_master_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('plant_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('safety_stock')
                ->rules(['max:255']),
            ImportColumn::make('minimal_safety_stock')
                ->rules(['max:255']),
            ImportColumn::make('con')
                ->rules(['max:255']),
            ImportColumn::make('is_extenal_batch')
                ->boolean()
                ->rules(['boolean']),
            ImportColumn::make('is_internal_batch')
                ->boolean()
                ->rules(['boolean']),
            ImportColumn::make('procurement_type_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('temperature_condition_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('storage_condition_id')
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

    public function resolveRecord(): ?MaterialMasterPlant
    {
        // return MaterialMasterPlant::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new MaterialMasterPlant();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your material master plant import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
