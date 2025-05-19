<?php

namespace App\Filament\Submonitoring\Resources;

use App\Filament\Exports\AccountDeterminationExporter;
use App\Filament\Imports\AccountDeterminationImporter;
use App\Filament\Submonitoring\Resources\AccountDeterminationItemResource\Pages;
use App\Filament\Submonitoring\Resources\AccountDeterminationItemResource\RelationManagers;
use App\Models\AccountDeterminationItem;
use App\Models\DebitCredit;
use App\Models\GlAccount;
use App\Models\GlAccountGroup;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Notifications\Notification;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\ExportBulkAction;
use Filament\Tables\Actions\ImportAction;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\ColumnGroup;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\QueryBuilder\Constraints\BooleanConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;

class AccountDeterminationItemResource extends Resource
{
    protected static ?string $model = AccountDeterminationItem::class;

    public static function canViewAny(): bool
    {
        return auth()->user()->id == 1;
    }

    protected static ?string $modelLabel = 'Account Determination Item';

    protected static ?string $pluralModelLabel = 'Account Determination Item';

    protected static ?string $navigationLabel = 'Account Determination Item';

    protected static ?int $navigationSort = 940000260;

    // protected static ?string $navigationIcon = 'heroicon-o-Qisms';

    // protected static ?string $cluster = FIBasicSettings::class;

    protected static ?string $navigationGroup = 'System';

    // protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    protected static ?string $recordTitleAttribute = 'record_title';

    public static function form(Form $form): Form
    {
        return $form

            ->schema(static::AccountDeterminationItemFormSchema());
    }

    public static function AccountDeterminationItemFormSchema(): array
    {
        return [

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

                ColumnGroup::make('Account Determination Item', [

                    TextColumn::make('accountDetermination.id')
                        ->label('Header')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('debitCredit.debit_credit')
                        ->label('D/C')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('glAccountGroup.gl_account_group_name')
                        ->label('GL Account Group')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('glAccount.gl_account_name')
                        ->label('GL Account')
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
            'index' => Pages\ListAccountDeterminationItems::route('/'),
            'create' => Pages\CreateAccountDeterminationItem::route('/create'),
            'view' => Pages\ViewAccountDeterminationItem::route('/{record}'),
            'edit' => Pages\EditAccountDeterminationItem::route('/{record}/edit'),
        ];
    }
}
