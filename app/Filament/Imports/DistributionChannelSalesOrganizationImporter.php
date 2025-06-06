<?php

namespace App\Filament\Imports;

use App\Models\DistributionChannelSalesOrganization;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class DistributionChannelSalesOrganizationImporter extends Importer
{
    protected static ?string $model = DistributionChannelSalesOrganization::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('distribution_channel_id')
                ->rules(['max:255']),
            ImportColumn::make('sales_organization_id')
                ->rules(['max:255']),
            ImportColumn::make('isactive')
                ->boolean()
                ->rules(['boolean']),
            ImportColumn::make('created_by')
                ->rules(['max:255']),
            ImportColumn::make('updated_by')
                ->rules(['max:255']),
        ];
    }

    public function resolveRecord(): ?DistributionChannelSalesOrganization
    {
        // return DistributionChannelSalesOrganization::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new DistributionChannelSalesOrganization();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your distribution channel sales organization import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
