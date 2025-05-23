<?php

namespace App\Filament\Imports;

use App\Models\GlAccount;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class GlAccountImporter extends Importer
{
    protected static ?string $model = GlAccount::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('gl_account')
                ->rules(['max:255']),
            ImportColumn::make('gl_account_name')
                ->rules(['max:255']),
            ImportColumn::make('gl_account_group_id')
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

    public function resolveRecord(): ?GlAccount
    {
        // return GlAccount::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new GlAccount();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your gl account import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
