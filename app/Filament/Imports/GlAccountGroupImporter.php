<?php

namespace App\Filament\Imports;

use App\Models\GlAccountGroup;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class GlAccountGroupImporter extends Importer
{
    protected static ?string $model = GlAccountGroup::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('gl_account_group')
                ->rules(['max:255']),
            ImportColumn::make('gl_account_group_name')
                ->rules(['max:255']),
            ImportColumn::make('chart_of_account_id')
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

    public function resolveRecord(): ?GlAccountGroup
    {
        // return GlAccountGroup::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new GlAccountGroup();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your gl account group import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
