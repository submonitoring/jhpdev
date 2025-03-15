<?php

namespace App\Filament\Submonitoring\Resources\BusinessPartnerResource\RelationManagers;

use App\Filament\Submonitoring\Resources\BusinessPartnerCompanyResource;
use App\Models\AccountAssignmentGroup;
use App\Models\CompanyCode;
use App\Models\Currency;
use App\Models\PaymentTerm;
use App\Models\TaxClassification;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Table;
use Guava\FilamentModalRelationManagers\Concerns\CanBeEmbeddedInModals;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Livewire\Livewire;

class BusinessPartnerCompaniesRelationManager extends RelationManager
{
    protected static string $relationship = 'businessPartnerCompanies';

    use CanBeEmbeddedInModals;

    public static function getNavigationLabel(): string
    {
        return 'Companies';
    }

    public function form(Form $form): Form
    {
        return $form

            ->schema(static::CompanyFormSchema())->columns(1);
    }

    public static function CompanyFormSchema(): array
    {
        return [
            Section::make('Company Code')
                ->schema([

                    Grid::make(2)
                        ->schema([

                            Select::make('company_code_id')
                                ->label('Company Code')
                                ->inlineLabel()
                                ->options(CompanyCode::where('is_active', 1)->pluck('company_code_name', 'id'))
                                ->required()
                                ->native(false),

                        ]),

                ])->compact(),

            Section::make('Customer Data')
                ->hidden(fn($livewire) => !in_array('1', $livewire->getOwnerRecord()->bp_role_id))
                ->schema([

                    Grid::make(2)
                        ->schema([

                            Select::make('cust_account_assignment_group_id')
                                ->label('Customer Account Assignment Group')
                                ->inlineLabel()
                                ->options(AccountAssignmentGroup::where('is_active', 1)->pluck('account_assignment_group_desc', 'id'))
                                // ->required()
                                ->native(false),

                        ]),

                    Grid::make(2)
                        ->schema([

                            Select::make('cust_tax_classification_id')
                                ->label('Customer Tax Classification')
                                ->inlineLabel()
                                ->options(TaxClassification::where('is_active', 1)->pluck('tax_classification_desc', 'id'))
                                // ->required()
                                ->native(false),

                        ]),

                    Grid::make(2)
                        ->schema([

                            Select::make('cust_currency_id')
                                ->label('Customer Currency')
                                ->inlineLabel()
                                ->options(Currency::where('is_active', 1)->pluck('currency', 'id'))
                                // ->required()
                                ->native(false),

                        ]),

                    Grid::make(2)
                        ->schema([

                            Select::make('cust_payment_term_id')
                                ->label('Customer Payment Term')
                                ->inlineLabel()
                                ->options(PaymentTerm::where('is_active', 1)->pluck('payment_term_name', 'id'))
                                // ->required()
                                ->native(false),

                        ]),

                ])->compact(),

            Section::make('Vendor Data')
                ->hidden(fn($livewire) => !in_array('2', $livewire->getOwnerRecord()->bp_role_id))
                ->schema([

                    Grid::make(2)
                        ->schema([

                            Select::make('vend_account_assignment_group_id')
                                ->label('Vendor Account Assignment Group')
                                ->inlineLabel()
                                ->options(AccountAssignmentGroup::where('is_active', 1)->pluck('account_assignment_group_desc', 'id'))
                                // ->required()
                                ->native(false),

                        ]),

                    Grid::make(2)
                        ->schema([

                            Select::make('vend_tax_classification_id')
                                ->label('Vendor Tax Classification')
                                ->inlineLabel()
                                ->options(TaxClassification::where('is_active', 1)->pluck('tax_classification_desc', 'id'))
                                // ->required()
                                ->native(false),

                        ]),

                    Grid::make(2)
                        ->schema([

                            Select::make('vend_currency_id')
                                ->label('Vendor Currency')
                                ->inlineLabel()
                                ->options(Currency::where('is_active', 1)->pluck('currency', 'id'))
                                // ->required()
                                ->native(false),

                        ]),

                    Grid::make(2)
                        ->schema([

                            Select::make('vend_payment_term_id')
                                ->label('Vendor Payment Term')
                                ->inlineLabel()
                                ->options(PaymentTerm::where('is_active', 1)->pluck('payment_term_name', 'id'))
                                // ->required()
                                ->native(false),

                        ]),

                ])->compact(),

            Section::make('Status')
                ->schema([

                    Grid::make(4)
                        ->schema([

                            ToggleButtons::make('is_active')
                                ->label('Active?')
                                ->boolean()
                                ->grouped()
                                ->default(true),

                        ]),
                ])->collapsible()
                ->compact(),
        ];
    }

    public function table(Table $table): Table
    {
        return BusinessPartnerCompanyResource::table($table)
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
