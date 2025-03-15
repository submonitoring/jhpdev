<?php

namespace App\Filament\Submonitoring\Resources\BusinessPartnerResource\RelationManagers;

use App\Filament\Submonitoring\Resources\BusinessPartnerCustomerResource;
use App\Models\AccountAssignmentGroup;
use App\Models\CompanyCode;
use App\Models\Currency;
use App\Models\DistributionChannel;
use App\Models\Division;
use App\Models\PaymentTerm;
use App\Models\SalesOrganization;
use App\Models\TaxClassification;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Table;
use Guava\FilamentModalRelationManagers\Concerns\CanBeEmbeddedInModals;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BusinessPartnerCustomersRelationManager extends RelationManager
{
    protected static string $relationship = 'businessPartnerCustomers';

    use CanBeEmbeddedInModals;

    public static function getNavigationLabel(): string
    {
        return 'Customers';
    }

    public function form(Form $form): Form
    {
        return BusinessPartnerCustomerResource::form($form);
    }

    public function table(Table $table): Table
    {
        return BusinessPartnerCustomerResource::table($table)
            ->recordTitleAttribute('business_partner_id')
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->modalWidth('full'),
            ])
            ->actions([
                ActionGroup::make([
                    ActionGroup::make([
                        Tables\Actions\ViewAction::make(),
                        Tables\Actions\EditAction::make(),
                    ])->dropdown(false),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
