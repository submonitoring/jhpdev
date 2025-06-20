<?php

namespace App\Filament\Submonitoring\Resources;

use App\Filament\Jhpadmin\Clusters\MaterialDocument as ClustersMaterialDocument;
use App\Filament\Submonitoring\Clusters\MaterialDocument as SubmonitoringClustersMaterialDocument;
use App\Filament\Submonitoring\Resources\MaterialDocumentResource\Pages;
use App\Filament\Submonitoring\Resources\MaterialDocumentResource\RelationManagers;
use App\Models\AccountDetermination;
use App\Models\AccountDeterminationItem;
use App\Models\BusinessPartner;
use App\Models\DebitCredit;
use App\Models\DocumentType;
use App\Models\GlAccount;
use App\Models\JournalEntry;
use App\Models\MaterialDocument;
use App\Models\MaterialDocumentCopyControl;
use App\Models\MaterialMaster;
use App\Models\MaterialMasterPlant;
use App\Models\MovementType;
use App\Models\NumberRange;
use App\Models\Plant;
use App\Models\TransactionReference;
use App\Models\TransactionType;
use App\Models\Uom;
use Awcodes\TableRepeater\Components\TableRepeater;
use Awcodes\TableRepeater\Header;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Notifications\Notification;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Resource;
use Filament\Support\Enums\Alignment;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\ExportBulkAction;
use Filament\Tables\Actions\ImportAction;
use Filament\Tables\Actions\RestoreAction;
use Filament\Tables\Columns\ColumnGroup;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\QueryBuilder\Constraints\BooleanConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Guava\FilamentModalRelationManagers\Actions\Table\RelationManagerAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\Relationship;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use Stevebauman\Purify\Facades\Purify;

use function Livewire\on;

class MaterialDocumentResource extends Resource
{
    protected static ?string $model = MaterialDocument::class;

    public static function canViewAny(): bool
    {
        return auth()->user()->id == 1;
    }

    protected static ?string $modelLabel = 'Material Document';

    protected static ?string $pluralModelLabel = 'Material Document';

    protected static ?string $navigationLabel = 'Material Document';

    protected static ?int $navigationSort = 822000000;

    // protected static ?string $navigationIcon = 'heroicon-o-Qisms';

    protected static ?string $cluster = SubmonitoringClustersMaterialDocument::class;

    // protected static ?string $navigationGroup = 'System';

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    protected static ?string $recordTitleAttribute = 'record_title';

    public static function form(Form $form): Form
    {
        return $form

            ->schema(static::MaterialDocumentFormSchema())->columns(1);
    }

    public static function MaterialDocumentFormSchema(): array
    {
        return [

            Section::make()
                ->icon('heroicon-o-document')
                ->schema([

                    Grid::make(4)
                        ->schema([

                            Select::make('transaction_type_id')
                                ->label('Transaction Type')
                                ->options(TransactionType::whereIsActive(1)->pluck('transaction_type_desc', 'id'))
                                ->native(false)
                                ->required()
                                ->disabledOn('edit')
                                ->live()
                                ->afterStateUpdated(function ($state, Set $set) {

                                    $doctype = TransactionType::where('id', $state)->first();

                                    $set('document_type_id', $doctype?->document_type_id);
                                    $set('transaction_reference_id', null);
                                    $set('document_date', null);
                                    $set('materialDocumentItems', null);
                                    $set('journalEntries', null);
                                }),

                            Select::make('transaction_reference_id')
                                ->label('Transaction Reference')
                                ->options(function (Get $get) {

                                    $getcopycontrol = MaterialDocumentCopyControl::whereIsActive(1)
                                        ->where('transaction_type_id', $get('transaction_type_id'))
                                        ->pluck('transaction_reference_id');

                                    return TransactionReference::whereIsActive(1)->whereIn('id', $getcopycontrol)->pluck('transaction_reference_desc', 'id');

                                })
                                ->disabled(fn(Get $get) =>
                                    is_null($get('transaction_type_id')))
                                ->native(false)
                                ->required()
                                ->live(),

                            Select::make('reference_document_number')
                                ->label('Reference Document Number')
                                ->options(function (Get $get) {

                                    $getcopycontrol = MaterialDocumentCopyControl::whereIsActive(1)
                                        ->where('transaction_type_id', $get('transaction_type_id'))
                                        ->where('transaction_reference_id', $get('transaction_reference_id'))
                                        ->first();

                                    return MaterialDocument::where('transaction_type_id', $getcopycontrol?->reference_transaction_type_id)->pluck('document_number', 'document_number');
                                })
                                ->native(false)
                                ->hidden(function (Get $get) {

                                    $getcopycontrol = MaterialDocumentCopyControl::whereIsActive(1)
                                        ->where('transaction_type_id', $get('transaction_type_id'))
                                        ->where('transaction_reference_id', $get('transaction_reference_id'))
                                        ->first();

                                    // dd($getcopycontrol);
                        
                                    if (is_null($getcopycontrol?->reference_transaction_type_id)) {

                                        return true;
                                    } else {
                                        return false;
                                    }
                                })
                                ->live(),

                            Hidden::make('document_type_id'),
                            Hidden::make('number_range_id')->label('NR Interval')->default(function () {
                                $nriid = NumberRange::where('number_range_interval', 'MATDOC')->first();
                                return ($nriid->id);
                            }),

                        ]),

                ])->compact(),

            Tabs::make()
                ->disabled(fn(Get $get) =>
                    is_null($get('transaction_type_id')))
                ->schema([

                    Tab::make('General')
                        // ->icon('heroicon-o-numbered-list')
                        ->schema([

                            Grid::make(4)
                                ->schema([

                                    TextInput::make('document_number')
                                        ->label('Document Number')
                                        ->disabled()
                                        ->hiddenOn('create'),
                                ]),

                            Grid::make(4)
                                ->schema([

                                    DatePicker::make('document_date')
                                        ->label('Document Date')
                                        ->locale('id')
                                        ->native(false)
                                        ->required()
                                        ->closeOnDateSelection(),
                                ]),

                            Grid::make(4)
                                ->schema([

                                    TextInput::make('external_po_number')
                                        ->label('External Document Number'),
                                ]),

                        ]),

                    Tab::make('BP')
                        // ->icon('heroicon-o-numbered-list')
                        ->schema([

                            Grid::make(4)
                                ->schema([

                                    Select::make('business_partner_id')
                                        ->label('Business Partner')
                                        ->options(BusinessPartner::whereIsActive(1)->pluck('name_1', 'id'))
                                        ->native(false),
                                ]),

                        ]),

                    Tab::make('Header Text')
                        // ->icon('heroicon-o-numbered-list')
                        ->schema([

                            RichEditor::make('text_header')
                                // ->label('Business Partner')
                                ->hiddenLabel(),

                        ]),

                ]),




            Tabs::make()
                ->disabled(fn(Get $get) =>
                    is_null($get('transaction_type_id')))
                ->schema([

                    Tab::make('Items')
                        ->icon('heroicon-o-numbered-list')
                        ->schema([



                            Repeater::make('materialDocumentItems')
                                // ->label('Customer Data')
                                ->relationship()
                                ->schema([

                                    Tabs::make()
                                        ->schema([

                                            Tab::make('Materials')
                                                // ->icon('heroicon-o-numbered-list')
                                                ->schema([

                                                    Grid::make(3)
                                                        ->schema([

                                                            Select::make('material_master_id')
                                                                ->label('Material')
                                                                ->allowHtml()
                                                                // ->options(MaterialMaster::where('is_active', 1)->pluck('material_desc', 'id'))
                                                                // ->preload()
                                                                ->searchable() // Don't forget to make it searchable otherwise there is no choices.js magic!
                                                                ->getSearchResultsUsing(function (string $search) {

                                                                    $materials = MaterialMaster::where('is_active', 1)->where('material_desc', 'like', "%{$search}%")->limit(50)->get();

                                                                    return $materials->mapWithKeys(function ($materialmaster) {
                                                                        return [$materialmaster->getKey() => static::getCleanOptionString($materialmaster)];
                                                                    })->toArray();
                                                                })
                                                                ->getOptionLabelUsing(function ($value): string {
                                                                    $materialmaster = MaterialMaster::find($value);

                                                                    return static::getCleanOptionString($materialmaster);
                                                                })
                                                                ->required()
                                                                ->preload()
                                                                ->native(false)
                                                                ->live()
                                                                ->afterStateUpdated(function (Get $get, Set $set, $state) {

                                                                    $set('quantity', null);
                                                                    $set('plant_id', null);
                                                                    $set('movement_type_id', null);
                                                                    $set('journalEntries', null);


                                                                }),

                                                            Select::make('plant_id')
                                                                ->label('Plant')
                                                                ->options(function (Get $get) {

                                                                    $material_master_id = $get('material_master_id');

                                                                    $getmaterialmasterplant = MaterialMasterPlant::where('material_master_id', $material_master_id)->pluck('plant_id');

                                                                    return (Plant::where('is_active', 1)->whereIn('id', $getmaterialmasterplant)->pluck('plant_name', 'id'));
                                                                })
                                                                ->required()
                                                                ->disabled(fn(Get $get) =>
                                                                    is_null($get('material_master_id')))
                                                                ->native(false)
                                                                ->live()
                                                                ->afterStateUpdated(function (Get $get, Set $set, $state) {

                                                                    $set('quantity', null);
                                                                    $set('movement_type_id', null);
                                                                    $set('journalEntries', null);
                                                                }),

                                                            Grid::make(3)
                                                                ->schema([

                                                                    TextInput::make('quantity')
                                                                        ->label('Qty')
                                                                        ->numeric()
                                                                        ->required()
                                                                        ->live()
                                                                        // ->disabled(fn(Get $get, $livewire) =>
                                                                        //     is_null($get('plant_id')) || (!is_null($livewire->record) && $get('transa')))
                                                                        ->disabled(function (Get $get, $livewire) {

                                                                            $transaction_type_id = $get('../../transaction_type_id');

                                                                            $document_type_id = TransactionType::where('id', $transaction_type_id)?->first();

                                                                            $module_aaa_id = DocumentType::where('id', $document_type_id->document_type_id)?->first();

                                                                            if (is_null($get('plant_id')) || (!is_null($livewire->record) && $module_aaa_id->is_matdoc_zero_qty_check == 1)) {
                                                                                return true;
                                                                            } elseif (is_null($get('plant_id')) || !(!is_null($livewire->record) && $module_aaa_id->is_matdoc_zero_qty_check == 1)) {
                                                                                return false;
                                                                            }

                                                                        })
                                                                        ->suffix(function (Get $get) {

                                                                            $getmaterial_master_id = MaterialMaster::where('id', $get('material_master_id'))->first();

                                                                            return $getmaterial_master_id?->baseUom?->uom;

                                                                        })
                                                                        ->maxValue(function (Get $get) {

                                                                            $transaction_type_id = $get('../../transaction_type_id');

                                                                            $document_type_id = TransactionType::where('id', $transaction_type_id)?->first();

                                                                            $module_aaa_id = DocumentType::where('id', $document_type_id->document_type_id)?->first();

                                                                            if ($module_aaa_id->is_matdoc_zero_qty_check == 1) {

                                                                                $getmaterial_master_id = $get('material_master_id');
                                                                                $getplant_id = $get('plant_id');

                                                                                $getjournalentriesdebit = JournalEntry::where('material_master_id', $getmaterial_master_id)
                                                                                    ->where('plant_id', $getplant_id)
                                                                                    ->where('debit_credit_id', 1)
                                                                                    ->where('gl_account_group_id', 1)?->sum('quantity');

                                                                                $getjournalentriescredit = JournalEntry::where('material_master_id', $getmaterial_master_id)
                                                                                    ->where('plant_id', $getplant_id)
                                                                                    ->where('debit_credit_id', 2)
                                                                                    ->where('gl_account_group_id', 1)?->sum('quantity');

                                                                                $availablestock = $getjournalentriesdebit - $getjournalentriescredit;

                                                                                return $availablestock;
                                                                            } elseif ($module_aaa_id->is_matdoc_zero_qty_check == 0) {
                                                                                return;
                                                                            }
                                                                        })
                                                                        ->helperText(function (Get $get) {
                                                                            $getmaterial_master_id = $get('material_master_id');
                                                                            $getplant_id = $get('plant_id');

                                                                            $getjournalentriesdebit = JournalEntry::where('material_master_id', $getmaterial_master_id)
                                                                                ->where('plant_id', $getplant_id)
                                                                                ->where('debit_credit_id', 1)
                                                                                ->where('gl_account_group_id', 1)?->sum('quantity');

                                                                            $getjournalentriescredit = JournalEntry::where('material_master_id', $getmaterial_master_id)
                                                                                ->where('plant_id', $getplant_id)
                                                                                ->where('debit_credit_id', 2)
                                                                                ->where('gl_account_group_id', 1)?->sum('quantity');

                                                                            $availablestock = $getjournalentriesdebit - $getjournalentriescredit;

                                                                            return (new HtmlString('Stok saat ini = <strong>' . $availablestock . '</strong>'));
                                                                        })
                                                                        ->afterStateUpdated(function ($state, Get $get, Set $set, $livewire, TextInput $component) {

                                                                            $transaction_type_id = $get('../../transaction_type_id');

                                                                            $document_type_id = TransactionType::where('id', $transaction_type_id)?->first();

                                                                            $module_aaa_id = DocumentType::where('id', $document_type_id->document_type_id)?->first();

                                                                            if ($module_aaa_id->is_matdoc_zero_qty_check == 1) {

                                                                                $livewire->validateOnly($component->getStatePath());

                                                                                $transaction_type_id = $get('../../transaction_type_id');

                                                                                $document_type_id = TransactionType::where('id', $transaction_type_id)?->first();

                                                                                $module_aaa_id = DocumentType::where('id', $document_type_id->document_type_id)?->first();

                                                                                if ($module_aaa_id->is_stock_transfer == 1) {
                                                                                    $transaction_type_id = $get('../../transaction_type_id');

                                                                                    $document_type_id = TransactionType::where('id', $transaction_type_id)?->first();

                                                                                    $module_aaa_id = DocumentType::where('id', $document_type_id->document_type_id)?->first();

                                                                                    $material_type_id = MaterialMaster::where('id', $get('material_master_id'))?->first();

                                                                                    $accountdeterminationdata = AccountDetermination::where('module_aaa_id', $module_aaa_id->module_aaa_id)
                                                                                        ->where('document_type_id', $document_type_id->document_type_id)
                                                                                        ->where('transaction_type_id', $transaction_type_id)
                                                                                        ->where('material_type_id', $material_type_id->material_type_id)->first();

                                                                                    $movement_type_id = AccountDetermination::where('module_aaa_id', $module_aaa_id->module_aaa_id)
                                                                                        ->where('document_type_id', $document_type_id->document_type_id)
                                                                                        ->where('transaction_type_id', $transaction_type_id)
                                                                                        ->where('material_type_id', $material_type_id->material_type_id)->first();

                                                                                    $material_master_id = $get('material_master_id');

                                                                                    $plant_id = $get('plant_id');

                                                                                    $to_plant_id = $get('to_plant_id');

                                                                                    $quantity = $get('quantity');

                                                                                    $set('movement_type_id', $movement_type_id->movement_type_id);

                                                                                    $journal_entries = $get('journalEntries') ?? [];

                                                                                    $accountdeterminations = AccountDeterminationItem::where('account_determination_id', $accountdeterminationdata->id)->where('debit_credit_id', 2)->where('is_active', 1)->get();

                                                                                    $journal_entries_value = $accountdeterminations->map(function ($accountdetermination) use ($module_aaa_id, $material_master_id, $quantity, $plant_id, $to_plant_id) {
                                                                                        return [
                                                                                            'debit_credit_id' => $accountdetermination->debit_credit_id,
                                                                                            'gl_account_group_id' => $accountdetermination->gl_account_group_id,
                                                                                            'gl_account_id' => $accountdetermination->gl_account_id,
                                                                                            'quantity' => $quantity,
                                                                                            'module_aaa_id' => $module_aaa_id->module_aaa_id,
                                                                                            'material_master_id' => $material_master_id,
                                                                                            'plant_id' => $plant_id,
                                                                                        ];
                                                                                    })->toArray();

                                                                                    // dd($accountdeterminationdata);
                                                                
                                                                                    array_push(
                                                                                        $journal_entries,
                                                                                        ...$journal_entries_value
                                                                                    );

                                                                                    return $set('journalEntries', $journal_entries_value);

                                                                                } elseif ($module_aaa_id->is_stock_transfer == 0) {
                                                                                    $transaction_type_id = $get('../../transaction_type_id');

                                                                                    $document_type_id = TransactionType::where('id', $transaction_type_id)?->first();

                                                                                    $module_aaa_id = DocumentType::where('id', $document_type_id->document_type_id)?->first();

                                                                                    $material_type_id = MaterialMaster::where('id', $get('material_master_id'))?->first();

                                                                                    $accountdeterminationdata = AccountDetermination::where('module_aaa_id', $module_aaa_id->module_aaa_id)
                                                                                        ->where('document_type_id', $document_type_id->document_type_id)
                                                                                        ->where('transaction_type_id', $transaction_type_id)
                                                                                        ->where('material_type_id', $material_type_id->material_type_id)->first();

                                                                                    $movement_type_id = AccountDetermination::where('module_aaa_id', $module_aaa_id->module_aaa_id)
                                                                                        ->where('document_type_id', $document_type_id->document_type_id)
                                                                                        ->where('transaction_type_id', $transaction_type_id)
                                                                                        ->where('material_type_id', $material_type_id->material_type_id)->first();

                                                                                    $material_master_id = $get('material_master_id');

                                                                                    $plant_id = $get('plant_id');

                                                                                    $to_plant_id = $get('to_plant_id');

                                                                                    $quantity = $get('quantity');

                                                                                    $set('movement_type_id', $movement_type_id->movement_type_id);

                                                                                    $journal_entries = $get('journalEntries') ?? [];

                                                                                    $accountdeterminations = AccountDeterminationItem::where('account_determination_id', $accountdeterminationdata->id)->where('is_active', 1)->get();


                                                                                    $journal_entries_value = $accountdeterminations->map(function ($accountdetermination) use ($module_aaa_id, $material_master_id, $quantity, $plant_id, $to_plant_id) {
                                                                                        return [
                                                                                            'debit_credit_id' => $accountdetermination->debit_credit_id,
                                                                                            'gl_account_group_id' => $accountdetermination->gl_account_group_id,
                                                                                            'gl_account_id' => $accountdetermination->gl_account_id,
                                                                                            'quantity' => $quantity,
                                                                                            'module_aaa_id' => $module_aaa_id->module_aaa_id,
                                                                                            'material_master_id' => $material_master_id,
                                                                                            'plant_id' => $plant_id,
                                                                                        ];
                                                                                    })->toArray();

                                                                                    // dd($accountdeterminationdata);
                                                                
                                                                                    array_replace(
                                                                                        $journal_entries,
                                                                                        ...$journal_entries_value
                                                                                    );

                                                                                    return $set('journalEntries', $journal_entries_value);
                                                                                }

                                                                            } elseif ($module_aaa_id->is_matdoc_zero_qty_check == 0) {

                                                                                $transaction_type_id = $get('../../transaction_type_id');

                                                                                $document_type_id = TransactionType::where('id', $transaction_type_id)?->first();

                                                                                $module_aaa_id = DocumentType::where('id', $document_type_id->document_type_id)?->first();

                                                                                if ($module_aaa_id->is_stock_transfer == 1) {
                                                                                    $transaction_type_id = $get('../../transaction_type_id');

                                                                                    $document_type_id = TransactionType::where('id', $transaction_type_id)?->first();

                                                                                    $module_aaa_id = DocumentType::where('id', $document_type_id->document_type_id)?->first();

                                                                                    $material_type_id = MaterialMaster::where('id', $get('material_master_id'))?->first();

                                                                                    $accountdeterminationdata = AccountDetermination::where('module_aaa_id', $module_aaa_id->module_aaa_id)
                                                                                        ->where('document_type_id', $document_type_id->document_type_id)
                                                                                        ->where('transaction_type_id', $transaction_type_id)
                                                                                        ->where('material_type_id', $material_type_id->material_type_id)->first();

                                                                                    $movement_type_id = AccountDetermination::where('module_aaa_id', $module_aaa_id->module_aaa_id)
                                                                                        ->where('document_type_id', $document_type_id->document_type_id)
                                                                                        ->where('transaction_type_id', $transaction_type_id)
                                                                                        ->where('material_type_id', $material_type_id->material_type_id)->first();

                                                                                    $material_master_id = $get('material_master_id');

                                                                                    $plant_id = $get('plant_id');

                                                                                    $to_plant_id = $get('to_plant_id');

                                                                                    $quantity = $get('quantity');

                                                                                    $set('movement_type_id', $movement_type_id->movement_type_id);

                                                                                    $journal_entries = $get('journalEntries') ?? [];

                                                                                    $accountdeterminations = AccountDeterminationItem::where('account_determination_id', $accountdeterminationdata->id)->where('debit_credit_id', 2)->where('is_active', 1)->get();

                                                                                    $journal_entries_value = $accountdeterminations->map(function ($accountdetermination) use ($module_aaa_id, $material_master_id, $quantity, $plant_id, $to_plant_id) {
                                                                                        return [
                                                                                            'debit_credit_id' => $accountdetermination->debit_credit_id,
                                                                                            'gl_account_group_id' => $accountdetermination->gl_account_group_id,
                                                                                            'gl_account_id' => $accountdetermination->gl_account_id,
                                                                                            'quantity' => $quantity,
                                                                                            'module_aaa_id' => $module_aaa_id->module_aaa_id,
                                                                                            'material_master_id' => $material_master_id,
                                                                                            'plant_id' => $plant_id,
                                                                                        ];
                                                                                    })->toArray();

                                                                                    // dd($accountdeterminationdata);
                                                                
                                                                                    array_push(
                                                                                        $journal_entries,
                                                                                        ...$journal_entries_value
                                                                                    );

                                                                                    return $set('journalEntries', $journal_entries_value);

                                                                                } elseif ($module_aaa_id->is_stock_transfer == 0) {
                                                                                    $transaction_type_id = $get('../../transaction_type_id');

                                                                                    $document_type_id = TransactionType::where('id', $transaction_type_id)?->first();

                                                                                    $module_aaa_id = DocumentType::where('id', $document_type_id->document_type_id)?->first();

                                                                                    $material_type_id = MaterialMaster::where('id', $get('material_master_id'))?->first();

                                                                                    $accountdeterminationdata = AccountDetermination::where('module_aaa_id', $module_aaa_id->module_aaa_id)
                                                                                        ->where('document_type_id', $document_type_id->document_type_id)
                                                                                        ->where('transaction_type_id', $transaction_type_id)
                                                                                        ->where('material_type_id', $material_type_id->material_type_id)->first();

                                                                                    $movement_type_id = AccountDetermination::where('module_aaa_id', $module_aaa_id->module_aaa_id)
                                                                                        ->where('document_type_id', $document_type_id->document_type_id)
                                                                                        ->where('transaction_type_id', $transaction_type_id)
                                                                                        ->where('material_type_id', $material_type_id->material_type_id)->first();

                                                                                    $material_master_id = $get('material_master_id');

                                                                                    $plant_id = $get('plant_id');

                                                                                    $to_plant_id = $get('to_plant_id');

                                                                                    $quantity = $get('quantity');

                                                                                    $set('movement_type_id', $movement_type_id->movement_type_id);

                                                                                    $journal_entries = $get('journalEntries') ?? [];

                                                                                    $accountdeterminations = AccountDeterminationItem::where('account_determination_id', $accountdeterminationdata->id)->where('is_active', 1)->get();


                                                                                    $journal_entries_value = $accountdeterminations->map(function ($accountdetermination) use ($module_aaa_id, $material_master_id, $quantity, $plant_id, $to_plant_id) {
                                                                                        return [
                                                                                            'debit_credit_id' => $accountdetermination->debit_credit_id,
                                                                                            'gl_account_group_id' => $accountdetermination->gl_account_group_id,
                                                                                            'gl_account_id' => $accountdetermination->gl_account_id,
                                                                                            'quantity' => $quantity,
                                                                                            'module_aaa_id' => $module_aaa_id->module_aaa_id,
                                                                                            'material_master_id' => $material_master_id,
                                                                                            'plant_id' => $plant_id,
                                                                                        ];
                                                                                    })->toArray();

                                                                                    // dd($accountdeterminationdata);
                                                                
                                                                                    array_replace(
                                                                                        $journal_entries,
                                                                                        ...$journal_entries_value
                                                                                    );

                                                                                    return $set('journalEntries', $journal_entries_value);
                                                                                }

                                                                            }
                                                                        }),

                                                                    Hidden::make('movement_type_id'),
                                                                ]),

                                                            Select::make('to_plant_id')
                                                                ->label('To Plant')
                                                                ->options(function (Get $get) {

                                                                    $material_master_id = $get('material_master_id');

                                                                    $getmaterialmasterplant = MaterialMasterPlant::where('material_master_id', $material_master_id)->pluck('plant_id');

                                                                    return (Plant::where('is_active', 1)->whereIn('id', $getmaterialmasterplant)->whereNotIn('id', array($get('plant_id')))->pluck('plant_name', 'id'));
                                                                })
                                                                ->required()
                                                                ->disabled(fn(Get $get) =>
                                                                    is_null($get('plant_id')))
                                                                ->hidden(function (Get $get) {

                                                                    $transaction_type_id = $get('../../transaction_type_id');

                                                                    $document_type_id = TransactionType::where('id', $transaction_type_id)?->first();

                                                                    $module_aaa_id = DocumentType::where('id', $document_type_id->document_type_id)?->first();

                                                                    if ($module_aaa_id->is_stock_transfer == 1) {
                                                                        return false;
                                                                    } elseif ($module_aaa_id->is_stock_transfer == 0) {
                                                                        return true;
                                                                    }
                                                                })
                                                                ->native(false)
                                                                ->live()
                                                                ->afterStateUpdated(function (Get $get, Set $set) {

                                                                    $transaction_type_id = $get('../../transaction_type_id');

                                                                    $document_type_id = TransactionType::where('id', $transaction_type_id)?->first();

                                                                    $module_aaa_id = DocumentType::where('id', $document_type_id->document_type_id)?->first();

                                                                    $material_type_id = MaterialMaster::where('id', $get('material_master_id'))?->first();

                                                                    $accountdeterminationdata = AccountDetermination::where('module_aaa_id', $module_aaa_id->module_aaa_id)
                                                                        ->where('document_type_id', $document_type_id->document_type_id)
                                                                        ->where('transaction_type_id', $transaction_type_id)
                                                                        ->where('material_type_id', $material_type_id->material_type_id)->first();

                                                                    $movement_type_id = AccountDetermination::where('module_aaa_id', $module_aaa_id->module_aaa_id)
                                                                        ->where('document_type_id', $document_type_id->document_type_id)
                                                                        ->where('transaction_type_id', $transaction_type_id)
                                                                        ->where('material_type_id', $material_type_id->material_type_id)->first();

                                                                    $material_master_id = $get('material_master_id');

                                                                    $plant_id = $get('plant_id');

                                                                    $to_plant_id = $get('to_plant_id');

                                                                    $quantity = $get('quantity');

                                                                    $set('movement_type_id', $movement_type_id->movement_type_id);

                                                                    $journal_entries = $get('journalEntries') ?? [];

                                                                    $accountdeterminations = AccountDeterminationItem::where('account_determination_id', $accountdeterminationdata->id)->where('debit_credit_id', 1)->where('is_active', 1)->get();

                                                                    $journal_entries_value = $accountdeterminations->map(function ($accountdetermination) use ($module_aaa_id, $material_master_id, $quantity, $plant_id, $to_plant_id) {
                                                                        return [
                                                                            'debit_credit_id' => $accountdetermination->debit_credit_id,
                                                                            'gl_account_group_id' => $accountdetermination->gl_account_group_id,
                                                                            'gl_account_id' => $accountdetermination->gl_account_id,
                                                                            'quantity' => $quantity,
                                                                            'module_aaa_id' => $module_aaa_id->module_aaa_id,
                                                                            'material_master_id' => $material_master_id,
                                                                            'plant_id' => $to_plant_id,
                                                                        ];
                                                                    })->toArray();

                                                                    array_push(
                                                                        $journal_entries,
                                                                        ...$journal_entries_value
                                                                    );

                                                                    return $set('journalEntries', $journal_entries);
                                                                }),

                                                        ]),

                                                ]),

                                            Tab::make('Item Text')
                                                // ->icon('heroicon-o-numbered-list')
                                                ->schema([

                                                    RichEditor::make('text_item')
                                                        // ->label('Business Partner')
                                                        ->hiddenLabel(),

                                                ]),

                                            Tab::make('Journal Entries')
                                                // ->icon('heroicon-o-numbered-list')
                                                ->schema([

                                                    TableRepeater::make('journalEntries')
                                                        ->label(' ')
                                                        ->relationship()
                                                        ->headers([
                                                            Header::make('D/C')
                                                                ->align(Alignment::Center),
                                                            Header::make('Account'),
                                                            Header::make('Quantity')
                                                                ->align(Alignment::Center),
                                                            Header::make('Plant')
                                                                ->align(Alignment::Center),
                                                        ])
                                                        ->schema([
                                                            Select::make('debit_credit_id')
                                                                ->label('D/C')
                                                                ->options(DebitCredit::where('is_active', 1)->pluck('debit_credit', 'id'))
                                                                ->required()
                                                                ->disabled()
                                                                ->dehydrated()
                                                                ->native(false),

                                                            Select::make('gl_account_id')
                                                                ->label('Account')
                                                                ->options(GlAccount::where('is_active', 1)->pluck('gl_account_name', 'id'))
                                                                ->required()
                                                                ->disabled()
                                                                ->dehydrated()
                                                                ->native(false),

                                                            TextInput::make('quantity')
                                                                ->label('Qty')
                                                                ->numeric()
                                                                ->disabled()
                                                                ->dehydrated()
                                                                ->required(),

                                                            Select::make('plant_id')
                                                                ->label('Plant')
                                                                ->options(Plant::where('is_active', 1)->pluck('plant_name', 'id'))
                                                                ->required()
                                                                ->disabled()
                                                                ->dehydrated()
                                                                ->native(false),

                                                            Hidden::make('module_aaa_id'),
                                                            Hidden::make('material_master_id'),
                                                            // Hidden::make('plant_id'),
                                                            Hidden::make('gl_account_group_id'),
                                                        ])
                                                        ->columnSpan('full')
                                                        ->defaultItems(0)
                                                        ->addable(false)
                                                        ->orderColumn('sort')
                                                        ->deletable(function () {
                                                            if (auth()->user()->id == 1) {
                                                                return true;
                                                            } else {
                                                                return false;
                                                            }
                                                        }),

                                                    // Repeater::make('journalEntries')
                                                    //     ->label(' ')
                                                    //     ->relationship()
                                                    //     ->schema([

                                                    //         Grid::make(3)
                                                    //             ->schema([

                                                    //                 Select::make('debit_credit_id')
                                                    //                     ->label('D/C')
                                                    //                     ->options(DebitCredit::where('is_active', 1)->pluck('debit_credit', 'id'))
                                                    //                     ->required()
                                                    //                     ->native(false),

                                                    //                 Select::make('gl_account_id')
                                                    //                     ->label('Account')
                                                    //                     ->options(GlAccount::where('is_active', 1)->pluck('gl_account_name', 'id'))
                                                    //                     ->required()
                                                    //                     ->native(false),

                                                    //                 TextInput::make('quantity')
                                                    //                     ->label('Qty')
                                                    //                     ->numeric()
                                                    //                     ->required(),
                                                    //             ]),
                                                    //     ])->defaultItems(0)
                                                    //     ->addable(false)
                                                    //     ->orderColumn('sort'),

                                                ]),

                                        ]),

                                ])
                                ->defaultItems(0)
                                ->orderColumn('sort'),

                        ]),

                ]),

        ];
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                ColumnGroup::make('Material Document', [
                    TextColumn::make('document_number')
                        ->label('Document Number')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('document_date')
                        ->label('Document Date')
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
                ]),

                ColumnGroup::make('Items', [

                    TextColumn::make('materialDocumentItems.materialMaster.material_desc')
                        ->label('Items')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->listWithLineBreaks()
                        ->bulleted(),

                    TextColumn::make('materialDocumentItems.quantity')
                        ->label('Quantity')
                        ->listWithLineBreaks()
                        ->bulleted(),

                    TextColumn::make('materialDocumentItems.plant.plant_name')
                        ->label('Plant')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->listWithLineBreaks()
                        ->bulleted(),

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
            ->defaultSort('document_date')
            ->recordUrl(null)
            ->searchOnBlur()
            ->defaultPaginationPageOption(1)
            ->filters([

                QueryBuilder::make()
                    ->constraintPickerColumns(1)
                    ->constraints([

                        TextConstraint::make('bp_number')
                            ->label('BP Number')
                            ->icon(false),

                        TextConstraint::make('name_1')
                            ->label('Name')
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

                    ])
            ], layout: Tables\Enums\FiltersLayout::AboveContentCollapsible)
            ->deferFilters()
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->icon('heroicon-o-plus'),

                // ImportAction::make()
                //     ->label('Import')
                //     ->importer(BusinessPartnerImporter::class),
            ])
            ->actions([
                ActionGroup::make([
                    ActionGroup::make([
                        Tables\Actions\ViewAction::make(),
                        Tables\Actions\EditAction::make(),
                        // Action::make('nonaktif')
                        //     ->label('Inactive')
                        //     ->color('danger')
                        //     ->icon('heroicon-o-x-circle')
                        //     ->requiresConfirmation()
                        //     ->action(function ($record) {

                        //         $cekbpcomp = BusinessPartnerCompany::where('business_partner_id', $record->id)->pluck('id')->toArray();
                        //         $cekbpcust = BusinessPartnerCustomer::where('business_partner_id', $record->id)->pluck('id')->toArray();
                        //         $cekbpvend = BusinessPartnerVendor::where('business_partner_id', $record->id)->pluck('id')->toArray();

                        //         // dd($cekbpcomp, $cekbpcust, $cekbpvend);

                        //         BusinessPartnerCompany::whereIn('id', $cekbpcomp)->update(['is_active' => 0]);

                        //         BusinessPartnerCustomer::whereIn('id', $cekbpcust)->update(['is_active' => 0]);

                        //         BusinessPartnerVendor::whereIn('id', $cekbpvend)->update(['is_active' => 0]);

                        //         $data['is_active'] = 0;
                        //         $record->update($data);

                        //         return $record;

                        //         Notification::make()
                        //             ->title('Status Material Document telah diubah menjadi Inactive')
                        //             ->color('danger')
                        //             ->send();
                        //     }),
                        // Action::make('aktif')
                        //     ->label('Activate')
                        //     ->color('success')
                        //     ->icon('heroicon-o-check-circle')
                        //     ->requiresConfirmation()
                        //     ->form([

                        //         Checkbox::make('massall')
                        //             ->label('Also activate all related Material Documents?'),

                        //     ])
                        //     ->action(function ($record, $data) {

                        //         if ($data['massall'] ==  true) {


                        //             $cekbpcomp = BusinessPartnerCompany::where('business_partner_id', $record->id)->pluck('id')->toArray();
                        //             $cekbpcust = BusinessPartnerCustomer::where('business_partner_id', $record->id)->pluck('id')->toArray();
                        //             $cekbpvend = BusinessPartnerVendor::where('business_partner_id', $record->id)->pluck('id')->toArray();

                        //             BusinessPartnerCompany::whereIn('id', $cekbpcomp)->update(['is_active' => 1]);

                        //             BusinessPartnerCustomer::whereIn('id', $cekbpcust)->update(['is_active' => 1]);

                        //             BusinessPartnerVendor::whereIn('id', $cekbpvend)->update(['is_active' => 1]);

                        //             $data['is_active'] = 1;
                        //             $record->update($data);
                        //             return $record;

                        //             Notification::make()
                        //                 ->title('Status Material Document telah diubah menjadi Active')
                        //                 ->color('danger')
                        //                 ->send();
                        //         } elseif ($data['massall'] ==  false) {

                        //             $data['is_active'] = 1;
                        //             $record->update($data);
                        //             return $record;

                        //             Notification::make()
                        //                 ->title('Status Material Document telah diubah menjadi Active')
                        //                 ->color('danger')
                        //                 ->send();
                        //         }
                        //     }),
                    ])->dropdown(false),
                ]),

                // Tables\Actions\Action::make('pdf')
                //     ->label('PDF')
                //     ->color('icon')
                //     ->icon('heroicon-o-document-arrow-down')
                //     ->url(fn(BusinessPartner $record) => route('pdf', $record))
                //     ->openUrlInNewTab(),

                // RelationManagerAction::make('createbpcomp')
                //     ->label('Company')
                //     ->icon('heroicon-m-arrow-right-end-on-rectangle')
                //     ->button()
                //     ->outlined()
                //     ->modalWidth('full')
                //     ->modalSubmitActionLabel('Save')
                //     ->relationManager(BusinessPartnerCompaniesRelationManager::make()),

                // RelationManagerAction::make('createbpcust')
                //     ->label('Customer')
                //     ->icon('heroicon-m-arrow-right-end-on-rectangle')
                //     ->button()
                //     ->outlined()
                //     ->modalWidth('full')
                //     ->modalSubmitActionLabel('Save')
                //     ->visible(fn($record) => in_array('1', $record->bp_role_id ?? []))
                //     ->relationManager(BusinessPartnerCustomersRelationManager::make()),

                // RelationManagerAction::make('createbpvend')
                //     ->label('Vendor')
                //     ->icon('heroicon-m-arrow-right-end-on-rectangle')
                //     ->button()
                //     ->outlined()
                //     ->modalWidth('full')
                //     ->modalSubmitActionLabel('Save')
                //     ->visible(fn($record) => in_array('2', $record->bp_role_id ?? []))
                //     ->relationManager(BusinessPartnerVendorsRelationManager::make()),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),

                // Tables\Actions\BulkAction::make('massinactivate')
                //     ->label(__('Mass Inactive'))
                //     ->color('danger')
                //     ->requiresConfirmation()
                //     ->modalIcon('heroicon-o-x-circle')
                //     ->modalIconColor('danger')
                //     ->modalHeading('Mass Inactive?')
                //     ->action(
                //         function (Collection $records, array $data) {

                //             $records->each(
                //                 function ($record) {

                //                     $cekbpcomp = BusinessPartnerCompany::where('business_partner_id', $record->id)->pluck('id')->toArray();
                //                     $cekbpcust = BusinessPartnerCustomer::where('business_partner_id', $record->id)->pluck('id')->toArray();
                //                     $cekbpvend = BusinessPartnerVendor::where('business_partner_id', $record->id)->pluck('id')->toArray();

                //                     // dd($cekbpcomp, $cekbpcust, $cekbpvend);

                //                     BusinessPartnerCompany::whereIn('id', $cekbpcomp)->update(['is_active' => 0]);

                //                     BusinessPartnerCustomer::whereIn('id', $cekbpcust)->update(['is_active' => 0]);

                //                     BusinessPartnerVendor::whereIn('id', $cekbpvend)->update(['is_active' => 0]);

                //                     $data['is_active'] = 0;
                //                     $record->update($data);
                //                     return $record;
                //                 }
                //             );
                //         }
                //     ),

                // Tables\Actions\BulkAction::make('massactivate')
                //     ->label(__('Mass Activate'))
                //     ->color('success')
                //     ->requiresConfirmation()
                //     ->modalIcon('heroicon-o-check-circle')
                //     ->modalIconColor('success')
                //     ->modalHeading('Mass Activate?')
                //     ->form([

                //         Checkbox::make('massall')
                //             ->label('Also change all related Material Documents?'),

                //     ])
                //     ->action(
                //         function (Collection $records, array $data) {

                //             // dd($data['massall']);

                //             if ($data['massall'] ==  true) {
                //                 $records->each(
                //                     function ($record) {

                //                         $cekbpcomp = BusinessPartnerCompany::where('business_partner_id', $record->id)->pluck('id')->toArray();
                //                         $cekbpcust = BusinessPartnerCustomer::where('business_partner_id', $record->id)->pluck('id')->toArray();
                //                         $cekbpvend = BusinessPartnerVendor::where('business_partner_id', $record->id)->pluck('id')->toArray();

                //                         // dd($cekbpcomp, $cekbpcust, $cekbpvend);

                //                         BusinessPartnerCompany::whereIn('id', $cekbpcomp)->update(['is_active' => 1]);

                //                         BusinessPartnerCustomer::whereIn('id', $cekbpcust)->update(['is_active' => 1]);

                //                         BusinessPartnerVendor::whereIn('id', $cekbpvend)->update(['is_active' => 1]);

                //                         $data['is_active'] = 1;
                //                         $record->update($data);
                //                         return $record;
                //                     }
                //                 );
                //             } elseif ($data['massall'] ==  false) {
                //                 $records->each(
                //                     function ($record) {

                //                         $data['is_active'] = 1;
                //                         $record->update($data);
                //                         return $record;
                //                     }
                //                 );
                //             }
                //         }
                //     ),

                // ExportBulkAction::make()
                //     ->label('Export')
                //     ->exporter(BusinessPartnerExporter::class)
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
            'index' => Pages\ListMaterialDocuments::route('/'),
            'create' => Pages\CreateMaterialDocument::route('/create'),
            'view' => Pages\ViewMaterialDocument::route('/{record}'),
            'edit' => Pages\EditMaterialDocument::route('/{record}/edit'),
        ];
    }

    public static function getCleanOptionString(Model $model): string
    {
        return Purify::clean(
            view('filament.components.select-material-result')
                ->with('material_desc', $model?->material_desc)
                ->with('base_uom', $model?->baseUom->uom)
                ->render()
        );
    }
}
