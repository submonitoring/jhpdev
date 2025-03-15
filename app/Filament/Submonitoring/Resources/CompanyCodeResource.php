<?php

namespace App\Filament\Submonitoring\Resources;

use App\Filament\Exports\CompanyCodeExporter;
use App\Filament\Imports\CompanyCodeImporter;
use App\Filament\Submonitoring\Clusters\FIOrgUnit;
use App\Filament\Submonitoring\Resources\CompanyCodeResource\Pages;
use App\Filament\Submonitoring\Resources\CompanyCodeResource\RelationManagers;
use App\Models\ChartOfAccount;
use App\Models\CompanyCode;
use App\Models\Currency;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Pages\Page;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Resource;
use Filament\Support\Enums\ActionSize;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\ExportBulkAction;
use Filament\Tables\Actions\ImportAction;
use Filament\Tables\Columns\ColumnGroup;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\QueryBuilder\Constraints\BooleanConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\SelectConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;
use Filament\Tables\Table;
use Guava\FilamentModalRelationManagers\Actions\Table\RelationManagerAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Schmeits\FilamentCharacterCounter\Forms\Components\TextInput;

class CompanyCodeResource extends Resource
{
    protected static ?string $model = CompanyCode::class;

    public static function canViewAny(): bool
    {
        return auth()->user()->id == 1;
    }

    protected static ?string $modelLabel = 'Company Code';

    protected static ?string $pluralModelLabel = 'Company Code';

    protected static ?string $navigationLabel = 'Company Code';

    protected static ?int $navigationSort = 810000020;

    // protected static ?string $navigationIcon = 'heroicon-o-Qisms';

    protected static ?string $cluster = FIOrgUnit::class;

    // protected static ?string $navigationGroup = 'System';

    // protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function form(Form $form): Form
    {
        return $form

            ->schema(static::CompanyCodeFormSchema());
    }

    public static function CompanyCodeFormSchema(): array
    {
        return [

            Section::make('Company Code')
                ->schema([

                    Grid::make(4)
                        ->schema([

                            TextInput::make('company_code')
                                ->label('Company Code')
                                ->required()
                                ->maxLength(4)
                                ->unique(Companycode::class, ignoreRecord: true),

                        ]),

                    Grid::make(4)
                        ->schema([

                            TextInput::make('company_code_name')
                                ->label('Name')
                                ->required(),

                        ]),

                ])
                ->compact(),

            Section::make('Chart of Account')
                ->schema([

                    Grid::make(4)
                        ->schema([

                            Select::make('chart_of_account_id')
                                ->label('Chart of Account')
                                ->options(ChartOfAccount::whereIsActive(1)->pluck('chart_of_account', 'id')),

                        ]),

                ])
                ->compact(),

            Section::make('Data')
                ->schema([

                    Grid::make(4)
                        ->schema([

                            TextInput::make('vat_number')
                                ->label('VAT Number')
                                ->numeric()
                                ->required(),

                        ]),

                    Grid::make(4)
                        ->schema([

                            Select::make('currency_id')
                                ->label('Currency')
                                ->options(Currency::whereIsActive(1)->pluck('currency', 'id')),

                        ]),

                ])
                ->compact(),

            Section::make('Status')
                ->schema([

                    Grid::make(2)
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

                ColumnGroup::make('Company Code', [

                    TextColumn::make('company_code')
                        ->label('Company Code')
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('company_code_name')
                        ->label('Name')
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                ]),

                ColumnGroup::make('Chart of Account', [

                    TextColumn::make('chartOfAccount.chart_of_account')
                        ->label('CoA')
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                ]),

                ColumnGroup::make('Data', [

                    TextColumn::make('currency.currency')
                        ->label('Currency')
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('vat_number')
                        ->label('VAT Number')
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),
                ]),

                ColumnGroup::make('Status', [

                    IconColumn::make('is_active')
                        ->label('Status')
                        ->boolean()
                        ->sortable(),

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

                        SelectConstraint::make('id')
                            ->label('Company Code (Options)')
                            ->options(Companycode::whereIsActive(1)->pluck('company_code', 'id'))
                            ->icon(false)
                            ->nullable(),

                        TextConstraint::make('company_code')
                            ->label('Company Code (Text)')
                            ->icon(false)
                            ->nullable(),

                        TextConstraint::make('company_code_name')
                            ->label('Name')
                            ->icon(false)
                            ->nullable(),

                        SelectConstraint::make('currency_id')
                            ->label('Currency')
                            ->options(Currency::whereIsActive(1)->pluck('currency', 'id'))
                            ->icon(false)
                            ->nullable(),

                        TextConstraint::make('vat_number')
                            ->label('VAT Number')
                            ->icon(false)
                            ->nullable(),


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
            ->headerActions([
                Tables\Actions\CreateAction::make(),

                ImportAction::make()
                    ->label('Import')
                    ->importer(CompanyCodeImporter::class),
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),

                ExportBulkAction::make()
                    ->label('Export')
                    ->exporter(CompanyCodeExporter::class)
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
            'index' => Pages\ListCompanyCodes::route('/'),
            'create' => Pages\CreateCompanyCode::route('/create'),
            'view' => Pages\ViewCompanyCode::route('/{record}'),
            'edit' => Pages\EditCompanyCode::route('/{record}/edit'),
        ];
    }
}
