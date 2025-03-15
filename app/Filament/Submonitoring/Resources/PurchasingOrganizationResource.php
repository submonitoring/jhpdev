<?php

namespace App\Filament\Submonitoring\Resources;

use App\Filament\Exports\PurchasingOrganizationExporter;
use App\Filament\Imports\PurchasingOrganizationImporter;
use App\Filament\Submonitoring\Clusters\MmOrgStruct;
use App\Filament\Submonitoring\Resources\PurchasingOrganizationResource\Pages;
use App\Filament\Submonitoring\Resources\PurchasingOrganizationResource\RelationManagers;
use App\Models\CompanyCode;
use App\Models\PurchasingOrganization;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
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
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\ColumnGroup;
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

class PurchasingOrganizationResource extends Resource
{
    protected static ?string $model = PurchasingOrganization::class;

    public static function canViewAny(): bool
    {
        return auth()->user()->id == 1;
    }

    protected static ?string $modelLabel = 'Purchasing Organization';

    protected static ?string $pluralModelLabel = 'Purchasing Organization';

    protected static ?string $navigationLabel = 'Purchasing Organization';

    protected static ?int $navigationSort = 812000040;

    // protected static ?string $navigationIcon = 'heroicon-o-Qisms';

    protected static ?string $cluster = MmOrgStruct::class;

    // protected static ?string $navigationGroup = 'System';

    // protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function form(Form $form): Form
    {
        return $form

            ->schema(static::PurchasingOrganizationFormSchema());
    }

    public static function PurchasingOrganizationFormSchema(): array
    {
        return [

            Section::make('Purchasing Organization')
                ->schema([

                    Grid::make(4)
                        ->schema([

                            TextInput::make('purchasing_organization')
                                ->label('Purchasing Organization')
                                ->required()
                                ->unique(PurchasingOrganization::class, ignoreRecord: true),

                        ]),

                    Grid::make(4)
                        ->schema([

                            TextInput::make('purchasing_organization_name')
                                ->label('Name')
                                ->required(),

                        ]),

                ])
                ->compact(),

            Section::make('Company Code')
                ->schema([

                    Grid::make(4)
                        ->schema([

                            Select::make('company_code_id')
                                ->label('Company Code')
                                ->options(CompanyCode::whereIsActive(1)->pluck('company_code_name', 'id')),

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

                ColumnGroup::make('Purchasing Organization', [

                    TextColumn::make('purchasing_organization')
                        ->label('Purchasing Organization')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('purchasing_organization_name')
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

                        TextConstraint::make('purchasing_organization')
                            ->label('Purchasing Organization')
                            ->nullable(),

                        TextConstraint::make('purchasing_organization_name')
                            ->label('Name')
                            ->nullable(),

                        SelectConstraint::make('company_code_id')
                            ->label('Company Code')
                            ->options(CompanyCode::whereIsActive(1)->pluck('company_code_name', 'id'))
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
                    ->importer(PurchasingOrganizationImporter::class)
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
                    ->exporter(PurchasingOrganizationExporter::class),

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
            'index' => Pages\ListPurchasingOrganizations::route('/'),
            'create' => Pages\CreatePurchasingOrganization::route('/create'),
            'view' => Pages\ViewPurchasingOrganization::route('/{record}'),
            'edit' => Pages\EditPurchasingOrganization::route('/{record}/edit'),
        ];
    }
}
