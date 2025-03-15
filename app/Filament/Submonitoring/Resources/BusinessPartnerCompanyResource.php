<?php

namespace App\Filament\Submonitoring\Resources;

use App\Filament\Exports\BusinessPartnerCompanyExporter;
use App\Filament\Submonitoring\Clusters\BusinessPartner;
use App\Filament\Submonitoring\Resources\BusinessPartnerCompanyResource\Pages;
use App\Filament\Submonitoring\Resources\BusinessPartnerCompanyResource\RelationManagers;
use App\Models\AccountAssignmentGroup;
use App\Models\BusinessPartnerCompany;
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
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\ExportBulkAction;
use Filament\Tables\Actions\ImportAction;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\ColumnGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\QueryBuilder\Constraints\BooleanConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BusinessPartnerCompanyResource extends Resource
{
    protected static ?string $model = BusinessPartnerCompany::class;

    public static function canViewAny(): bool
    {
        return auth()->user()->id == 1;
    }

    protected static ?string $modelLabel = 'Company';

    protected static ?string $pluralModelLabel = 'Company';

    protected static ?string $navigationLabel = 'Company';

    protected static ?int $navigationSort = 822000015;

    // protected static ?string $navigationIcon = 'heroicon-o-Qisms';

    protected static ?string $cluster = BusinessPartner::class;

    // protected static ?string $navigationGroup = 'System';

    // protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function form(Form $form): Form
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

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                ColumnGroup::make('Business Partner', [

                    TextColumn::make('businessPartner.title.title')
                        ->label('Title')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('businessPartner.name_1')
                        ->label('Name')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                ]),

                ColumnGroup::make('Company Code', [

                    TextColumn::make('companyCode.company_code_name')
                        ->label('Company Code')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                ]),

                ColumnGroup::make('Status', [

                    CheckboxColumn::make('is_active')
                        ->label('Status')
                        ->sortable()
                        ->alignCenter(),

                ]),

                ColumnGroup::make('Logs', [

                    TextColumn::make('created_by')
                        ->label('Created by')
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('updated_by')
                        ->label('Updated by')
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('created_at')
                        ->dateTime()
                        ->sortable()
                        ->toggleable(isToggledHiddenByDefault: true),

                    TextColumn::make('updated_at')
                        ->dateTime()
                        ->sortable()
                        ->toggleable(isToggledHiddenByDefault: true),

                ]),
            ])
            ->recordUrl(null)
            ->searchOnBlur()
            ->filters([
                QueryBuilder::make()
                    ->constraintPickerColumns(1)
                    ->constraints([

                        BooleanConstraint::make('is_active')
                            ->label('Status')
                            ->icon(false)
                            ->nullable(),

                        TextConstraint::make('created_by')
                            ->label('Created by')
                            ->icon(false)
                            ->nullable(),

                        TextConstraint::make('updated_by')
                            ->label('Updated by')
                            ->icon(false)
                            ->nullable(),

                        DateConstraint::make('created_at')
                            ->icon(false)
                            ->nullable(),

                        DateConstraint::make('updated_at')
                            ->icon(false)
                            ->nullable(),

                    ]),
            ])
            ->headerActions([])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                ]),


            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([]),

                ExportBulkAction::make()
                    ->label('Export')
                    ->exporter(BusinessPartnerCompanyExporter::class),

            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBusinessPartnerCompanies::route('/'),
            'create' => Pages\CreateBusinessPartnerCompany::route('/create'),
            'view' => Pages\ViewBusinessPartnerCompany::route('/{record}'),
            'edit' => Pages\EditBusinessPartnerCompany::route('/{record}/edit'),
        ];
    }
}
