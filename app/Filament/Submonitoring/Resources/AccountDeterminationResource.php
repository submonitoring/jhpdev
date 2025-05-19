<?php

namespace App\Filament\Submonitoring\Resources;

use App\Filament\Exports\AccountDeterminationExporter;
use App\Filament\Imports\AccountDeterminationImporter;
use App\Filament\Submonitoring\Resources\AccountDeterminationResource\Pages;
use App\Filament\Submonitoring\Resources\AccountDeterminationResource\RelationManagers;
use App\Models\AccountDetermination;
use App\Models\DebitCredit;
use App\Models\DocumentType;
use App\Models\GlAccount;
use App\Models\GlAccountGroup;
use App\Models\MaterialType;
use App\Models\ModuleAaa;
use App\Models\MovementType;
use App\Models\TransactionType;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\ExportBulkAction;
use Filament\Tables\Actions\ImportAction;
use Filament\Tables\Actions\ReplicateAction;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\ColumnGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\QueryBuilder\Constraints\BooleanConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;
use Filament\Tables\Table;
use Guava\FilamentModalRelationManagers\Actions\Table\RelationManagerAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;

class AccountDeterminationResource extends Resource
{
    protected static ?string $model = AccountDetermination::class;

    public static function canViewAny(): bool
    {
        return auth()->user()->id == 1;
    }

    protected static ?string $modelLabel = 'Account Determination';

    protected static ?string $pluralModelLabel = 'Account Determination';

    protected static ?string $navigationLabel = 'Account Determination';

    protected static ?int $navigationSort = 940000250;

    // protected static ?string $navigationIcon = 'heroicon-o-Qisms';

    // protected static ?string $cluster = FIBasicSettings::class;

    protected static ?string $navigationGroup = 'System';

    // protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    protected static ?string $recordTitleAttribute = 'record_title';

    public static function form(Form $form): Form
    {
        return $form

            ->schema(static::AccountDeterminationFormSchema());
    }

    public static function AccountDeterminationFormSchema(): array
    {
        return [

            Section::make('Account Determination')
                ->schema([

                    Grid::make(2)
                        ->schema([

                            ToggleButtons::make('module_aaa_id')
                                ->label('Module Aaa')
                                ->inline()
                                ->inlineLabel()
                                ->options(ModuleAaa::whereIsActive(1)->pluck('module_aaa', 'id'))
                                ->required(),

                        ]),

                    Grid::make(2)
                        ->schema([

                            ToggleButtons::make('document_type_id')
                                ->label('Document Type')
                                ->inline()
                                ->inlineLabel()
                                ->options(DocumentType::whereIsActive(1)->pluck('document_type_desc', 'id'))
                                ->required(),

                        ]),

                    Grid::make(2)
                        ->schema([

                            ToggleButtons::make('transaction_type_id')
                                ->label('Transaction Type')
                                ->inline()
                                ->inlineLabel()
                                ->options(TransactionType::whereIsActive(1)->pluck('transaction_type_desc', 'id'))
                                ->required(),

                        ]),

                    Grid::make(2)
                        ->schema([

                            ToggleButtons::make('material_type_id')
                                ->label('Material Type')
                                ->inline()
                                ->inlineLabel()
                                ->options(MaterialType::whereIsActive(1)->pluck('material_type_desc', 'id'))
                                ->required(),

                        ]),

                    Grid::make(2)
                        ->schema([

                            ToggleButtons::make('movement_type_id')
                                ->label('Movement Type')
                                ->inline()
                                ->inlineLabel()
                                ->options(MovementType::whereIsActive(1)->pluck('movement_type_desc', 'id'))
                                ->required(),

                        ]),

                ])
                ->compact(),

            Section::make('Account Determination Items')
                ->schema([

                    Repeater::make('accountDeterminationItems')
                        ->label(' ')
                        ->relationship()
                        ->schema([

                            Section::make('Account Determination Item')
                                ->schema([

                                    Grid::make(2)
                                        ->schema([

                                            ToggleButtons::make('debit_credit_id')
                                                ->label('Debit Credit')
                                                ->inline()
                                                ->inlineLabel()
                                                ->options(DebitCredit::whereIsActive(1)->pluck('debit_credit', 'id'))
                                                ->required(),

                                            ToggleButtons::make('gl_account_group_id')
                                                ->label('GL Account Group')
                                                ->inline()
                                                ->inlineLabel()
                                                ->options(GlAccountGroup::whereIsActive(1)->pluck('gl_account_group_name', 'id'))
                                                ->required()
                                                ->live(),

                                            ToggleButtons::make('gl_account_id')
                                                ->label('GL Account')
                                                ->inline()
                                                ->inlineLabel()
                                                ->options(function (Get $get) {

                                                    $glaccountgroup = $get('gl_account_group_id');

                                                    return (GlAccount::whereIsActive(1)->where('gl_account_group_id', $glaccountgroup)->pluck('gl_account_name', 'id'));
                                                })
                                                ->required(),

                                        ]),

                                ])
                                ->compact(),

                            Hidden::make('is_active')
                                ->default(1),
                        ])
                        ->defaultItems(0)
                        // ->maxItems(1)
                        ->orderColumn('sort')
                ])->compact(),

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

                ColumnGroup::make('Account Determination', [

                    TextColumn::make('moduleAaa.module_aaa')
                        ->label('Module')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('documentType.document_type_desc')
                        ->label('Document Type')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('transactionType.transaction_type_desc')
                        ->label('Transaction Type')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('materialType.material_type_desc')
                        ->label('Material Type')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('movementType.movement_type_desc')
                        ->label('Movement Type')
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
            ->headerActions([
                Tables\Actions\CreateAction::make(),

                ImportAction::make()
                    ->label('Import')
                    ->importer(AccountDeterminationImporter::class)
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),

                ReplicateAction::make()
                    ->successRedirectUrl(fn(Model $replica): string => route('filament.submonitoring.resources.account-determinations.edit', $replica)),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),

                ExportBulkAction::make()
                    ->label('Export')
                    ->exporter(AccountDeterminationExporter::class),

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
            'index' => Pages\ListAccountDeterminations::route('/'),
            'create' => Pages\CreateAccountDetermination::route('/create'),
            'view' => Pages\ViewAccountDetermination::route('/{record}'),
            'edit' => Pages\EditAccountDetermination::route('/{record}/edit'),
        ];
    }
}
