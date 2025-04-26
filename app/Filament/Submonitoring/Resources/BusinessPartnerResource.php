<?php

namespace App\Filament\Submonitoring\Resources;

use App\Filament\Exports\BusinessPartnerExporter;
use App\Filament\Imports\BusinessPartnerImporter;
use App\Filament\Submonitoring\Clusters\BusinessPartner as ClustersBusinessPartner;
use App\Filament\Submonitoring\Resources\BusinessPartnerResource\Pages;
use App\Filament\Submonitoring\Resources\BusinessPartnerResource\RelationManagers;
use App\Filament\Submonitoring\Resources\BusinessPartnerResource\RelationManagers\BusinessPartnerCompaniesRelationManager;
use App\Filament\Submonitoring\Resources\BusinessPartnerResource\RelationManagers\BusinessPartnerCustomersRelationManager;
use App\Filament\Submonitoring\Resources\BusinessPartnerResource\RelationManagers\BusinessPartnerVendorsRelationManager;
use App\Models\AccountAssignmentGroup;
use App\Models\BpCategory;
use App\Models\BpCategoryTitle;
use App\Models\BpRole;
use App\Models\BusinessPartner;
use App\Models\BusinessPartnerCompany;
use App\Models\BusinessPartnerCustomer;
use App\Models\BusinessPartnerVendor;
use App\Models\CompanyCode;
use App\Models\Country;
use App\Models\Currency;
use App\Models\DistributionChannel;
use App\Models\Division;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Kodepos;
use App\Models\NumberRange;
use App\Models\PaymentTerm;
use App\Models\Provinsi;
use App\Models\PurchasingOrganization;
use App\Models\SalesOrganization;
use App\Models\TaxClassification;
use App\Models\Title;
use Awcodes\TableRepeater\Components\TableRepeater;
use Awcodes\TableRepeater\Header;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
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
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;
use Schmeits\FilamentCharacterCounter\Forms\Components\Textarea;
use Schmeits\FilamentCharacterCounter\Forms\Components\TextInput;
use Illuminate\Support\Str;

class BusinessPartnerResource extends Resource
{
    protected static ?string $model = BusinessPartner::class;

    public static function canViewAny(): bool
    {
        return auth()->user()->id == 1;
    }

    protected static ?string $modelLabel = 'Business Partner';

    protected static ?string $pluralModelLabel = 'Business Partner';

    protected static ?string $navigationLabel = 'Business Partner';

    protected static ?int $navigationSort = 822000000;

    // protected static ?string $navigationIcon = 'heroicon-o-Qisms';

    protected static ?string $cluster = ClustersBusinessPartner::class;

    // protected static ?string $navigationGroup = 'System';

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    protected static ?string $recordTitleAttribute = 'record_title';

    public static function form(Form $form): Form
    {
        return $form

            ->schema(static::BusinessPartnerFormSchema())->columns(1);
    }

    public static function BusinessPartnerFormSchema(): array
    {
        return [

            Section::make()
                ->icon('heroicon-o-user-group')
                ->schema([

                    ToggleButtons::make('bp_role_id')
                        ->label('Business Partner as Role')
                        ->options(BpRole::whereIsActive(1)->pluck('bp_role_desc', 'id'))
                        ->inline()
                        ->multiple()
                        // ->required()
                        ->live()
                        ->hintIcon('heroicon-m-question-mark-circle', tooltip: 'Pilih Customer jika Business Partner merupakan pembeli.  Pilih Vendor jika Business Partner merupakan supplier.'),

                ])->compact(),

            Tabs::make()
                ->schema([

                    Tab::make('BP Data')
                        // ->icon('heroicon-o-user-group')
                        ->schema([

                            Hidden::make('number_range_id')
                                ->label('NR Interval')
                                ->default(function () {

                                    $nriid = NumberRange::where('number_range_interval', 'BP')->first();

                                    return ($nriid->id);
                                }),

                            Grid::make(4)
                                ->schema([

                                    Fieldset::make('BP Number')
                                        ->schema([

                                            TextInput::make('bp_number')
                                                // ->label('BP Number')
                                                ->hiddenLabel()
                                                ->disabled(),
                                        ])->hiddenOn('create'),

                                ]),


                            Split::make([
                                Fieldset::make('Nama')
                                    ->schema([

                                        Grid::make(4)
                                            ->schema([


                                                ToggleButtons::make('bp_category_id')
                                                    ->label('Business Partner Category')
                                                    ->options(BpCategory::whereIsActive(1)->pluck('bp_category_desc', 'id'))
                                                    ->live()
                                                    ->inline()
                                                    ->afterStateUpdated(function (Set $set) {
                                                        $set('title_id', null);
                                                    }),

                                            ]),

                                        Grid::make(4)
                                            ->schema([
                                                Select::make('title_id')
                                                    ->label('Title')
                                                    ->required()
                                                    ->options(function (Get $get) {

                                                        $bpcategory = $get('bp_category_id');

                                                        $title = BpCategoryTitle::where('isactive', 1)->where('bp_category_id', $bpcategory)->pluck('title_id');

                                                        return (Title::whereIn('id', $title)->pluck('title', 'id'));
                                                    })
                                                    ->native(false)
                                                    ->disabled(fn(Get $get) =>
                                                    $get('bp_category_id') == null),

                                            ]),

                                        Grid::make()
                                            ->schema([

                                                TextInput::make('name_1')
                                                    ->required()
                                                    ->label('Name')
                                                    ->disabled(fn(Get $get) =>
                                                    $get('bp_category_id') == null)
                                                    ->extraInputAttributes(['style' => 'font-size: 1.5rem;height: 3rem;']),

                                            ]),

                                        Grid::make()
                                            ->schema([

                                                TextInput::make('search_term')
                                                    ->label('Search Term')
                                                    ->disabled(fn(Get $get) =>
                                                    $get('bp_category_id') == null),

                                            ])

                                    ])

                            ]),

                            Split::make([
                                Fieldset::make('Communication')
                                    ->schema([

                                        Grid::make(4)
                                            ->schema([

                                                TextInput::make('telephone_number_1')
                                                    ->tel()
                                                    ->label('Telp 1'),

                                                TextInput::make('telephone_number_1_ext')
                                                    ->label('Telp 1 Extension'),

                                            ]),

                                        // Grid::make(4)
                                        //     ->schema([

                                        //         TextInput::make('telephone_number_2')
                                        //             ->tel()
                                        //             ->label('Telp 2'),

                                        //         TextInput::make('telephone_number_2_ext')
                                        //             ->label('Telp 2 Extension'),

                                        //     ]),

                                        Grid::make(4)
                                            ->schema([

                                                TextInput::make('fax_number_1')
                                                    ->tel()
                                                    ->label('Fax 1'),

                                                TextInput::make('fax_number_1_ext')
                                                    ->label('Fax 1 Extension'),

                                            ]),

                                        // Grid::make(4)
                                        //     ->schema([

                                        //         TextInput::make('fax_number_2')
                                        //             ->tel()
                                        //             ->label('Fax 2'),

                                        //         TextInput::make('fax_number_2_ext')
                                        //             ->label('Fax 2 Extension'),

                                        //     ]),

                                        Grid::make(4)
                                            ->schema([

                                                TextInput::make('handphone_number_1')
                                                    ->tel()
                                                    ->label('Handphone 1'),

                                                TextInput::make('handphone_number_2')
                                                    ->tel()
                                                    ->label('Handphone 2'),

                                            ]),

                                        Grid::make(4)
                                            ->schema([

                                                TextInput::make('email')
                                                    ->label('Email')
                                                    ->email(),

                                            ]),

                                    ])
                                    ->columnspan(4),

                            ]),

                            Split::make([
                                Fieldset::make('Address')
                                    ->schema([

                                        Grid::make(4)
                                            ->schema([

                                                Select::make('country_id')
                                                    ->label('Country')
                                                    ->live()
                                                    ->options(Country::whereIsActive(1)->pluck('country_name', 'id'))
                                                    // ->native(false)
                                                    ->default(105)
                                                    // ->disabled()
                                                    ->dehydrated(),

                                            ]),

                                        //if country_id = 105
                                        Grid::make(4)
                                            ->schema([

                                                Select::make('provinsi_id')
                                                    ->label('Provinsi')
                                                    ->placeholder('Pilih Provinsi')
                                                    ->options(Provinsi::whereIsActive(1)->pluck('provinsi', 'id'))
                                                    ->searchable()
                                                    ->required()
                                                    ->live()
                                                    ->native(false)
                                                    ->hidden(fn(Get $get) =>
                                                    $get('country_id') != 105)
                                                    ->afterStateUpdated(function (Set $set) {
                                                        $set('kabupaten_id', null);
                                                        $set('kecamatan_id', null);
                                                        $set('kelurahan_id', null);
                                                        $set('kodepos', null);
                                                    }),

                                                Select::make('kabupaten_id')
                                                    ->label('Kabupaten')
                                                    ->placeholder('Pilih Kabupaten')
                                                    ->options(fn(Get $get): Collection => Kabupaten::query()
                                                        ->where('provinsi_id', $get('provinsi_id'))
                                                        ->pluck('kabupaten', 'id'))
                                                    ->searchable()
                                                    // ->required()
                                                    ->live()
                                                    ->native(false)
                                                    ->disabled(fn(Get $get) =>
                                                    $get('provinsi_id') == null)
                                                    ->hidden(fn(Get $get) =>
                                                    $get('country_id') != 105),

                                                Select::make('kecamatan_id')
                                                    ->label('Kecamatan')
                                                    ->placeholder('Pilih Kecamatan')
                                                    ->options(fn(Get $get): Collection => Kecamatan::query()
                                                        ->where('kabupaten_id', $get('kabupaten_id'))
                                                        ->pluck('kecamatan', 'id'))
                                                    ->searchable()
                                                    // ->required()
                                                    ->live()
                                                    ->native(false)
                                                    ->disabled(fn(Get $get) =>
                                                    $get('kabupaten_id') == null)
                                                    ->hidden(fn(Get $get) =>
                                                    $get('country_id') != 105),

                                                Select::make('kelurahan_id')
                                                    ->label('Kelurahan')
                                                    ->placeholder('Pilih Kelurahan')
                                                    ->options(fn(Get $get): Collection => Kelurahan::query()
                                                        ->where('kecamatan_id', $get('kecamatan_id'))
                                                        ->pluck('kelurahan', 'id'))
                                                    ->searchable()
                                                    // ->required()
                                                    ->live()
                                                    ->native(false)
                                                    ->disabled(fn(Get $get) =>
                                                    $get('kecamatan_id') == null)
                                                    ->hidden(fn(Get $get) =>
                                                    $get('country_id') != 105)
                                                    ->afterStateUpdated(function (Get $get, ?string $state, Set $set, ?string $old) {

                                                        if (($get('kodepos') ?? '') != Str::slug($old)) {
                                                            return;
                                                        }

                                                        $kodepos = Kodepos::where('kelurahan_id', $state)->first();

                                                        $set('kodepos_id', $kodepos->id);
                                                        $set('kodepos', $kodepos->kodepos);
                                                    }),

                                                Textarea::make('alamat')
                                                    ->label('Alamat')
                                                    // ->required()
                                                    ->columnSpanFull()
                                                    ->disabled(fn(Get $get) =>
                                                    $get('kelurahan_id') == null)
                                                    ->hidden(fn(Get $get) =>
                                                    $get('country_id') != 105),

                                                TextInput::make('rt')
                                                    ->label('RT')
                                                    ->numeric()
                                                    // ->required()
                                                    ->disabled(fn(Get $get) =>
                                                    $get('kelurahan_id') == null)
                                                    ->hidden(fn(Get $get) =>
                                                    $get('country_id') != 105),

                                                TextInput::make('rw')
                                                    ->label('RW')
                                                    ->numeric()
                                                    // ->required()
                                                    ->disabled(fn(Get $get) =>
                                                    $get('kelurahan_id') == null)
                                                    ->hidden(fn(Get $get) =>
                                                    $get('country_id') != 105),

                                                TextInput::make('kodepos')
                                                    ->label('Kodepos')
                                                    ->disabled()
                                                    // ->required()
                                                    ->dehydrated()
                                                    ->hidden(fn(Get $get) =>
                                                    $get('country_id') != 105),

                                                Hidden::make('kodepos_id'),
                                            ]),
                                        //end of if country_id = 105

                                        //if country_id != 105
                                        Grid::make(4)
                                            ->schema([

                                                Textarea::make('street')
                                                    ->label('Street')
                                                    ->required()
                                                    ->columnSpanFull()
                                                    ->hidden(fn(Get $get) =>
                                                    $get('country_id') == 105 ||
                                                        $get('country_id') == null),

                                            ]),

                                        Grid::make(4)
                                            ->schema([

                                                TextInput::make('building_number')
                                                    ->label('Building Number')
                                                    // ->required()
                                                    ->hidden(fn(Get $get) =>
                                                    $get('country_id') == 105 ||
                                                        $get('country_id') == null),

                                            ]),

                                        Grid::make(4)
                                            ->schema([

                                                TextInput::make('floor')
                                                    ->label('Floor')
                                                    // ->required()
                                                    ->hidden(fn(Get $get) =>
                                                    $get('country_id') == 105 ||
                                                        $get('country_id') == null),

                                            ]),

                                        Grid::make(4)
                                            ->schema([

                                                TextInput::make('room')
                                                    ->label('Room')
                                                    // ->required()
                                                    ->hidden(fn(Get $get) =>
                                                    $get('country_id') == 105 ||
                                                        $get('country_id') == null),

                                            ]),

                                        Grid::make(4)
                                            ->schema([

                                                TextInput::make('city')
                                                    ->label('City')
                                                    // ->required()
                                                    ->hidden(fn(Get $get) =>
                                                    $get('country_id') == 105 ||
                                                        $get('country_id') == null),

                                            ]),

                                        Grid::make(4)
                                            ->schema([

                                                TextInput::make('district')
                                                    ->label('District')
                                                    // ->required()
                                                    ->hidden(fn(Get $get) =>
                                                    $get('country_id') == 105 ||
                                                        $get('country_id') == null),

                                            ]),

                                        Grid::make(4)
                                            ->schema([

                                                TextInput::make('po_box')
                                                    ->label('PO Box')
                                                    ->numeric()
                                                    // ->required()
                                                    ->hidden(fn(Get $get) =>
                                                    $get('country_id') == 105 ||
                                                        $get('country_id') == null),
                                            ]),
                                        //end of if country_id != 105


                                    ])
                                    ->columnspan(4),

                            ]),

                            Fieldset::make('Tax Data')
                                ->schema([
                                    Grid::make(4)
                                        ->schema([

                                            TextInput::make('vat_number')
                                                ->label('NPWP')
                                                ->numeric()
                                                ->length(16)
                                                ->maxLength(16),
                                            // ->required(),
                                        ]),
                                ]),

                            Fieldset::make('Sales')
                                ->schema([
                                    Grid::make(4)
                                        ->schema([

                                            TextInput::make('nib')
                                                ->label('NIB')
                                                ->numeric()
                                                ->length(13)
                                                ->maxLength(13)
                                                ->hintIcon('heroicon-m-question-mark-circle', tooltip: 'NIB = Nomor Induk Berusaha'),
                                        ]),
                                ]),

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


                        ]),

                    Tab::make(__('Company Data'))
                        // ->icon('heroicon-o-list-bullet')
                        ->schema([

                            Repeater::make('businessPartnerCompanies')
                                ->label('Company Code Data')
                                ->relationship()
                                ->schema([

                                    Fieldset::make('Company Code Data')
                                        ->schema([

                                            Grid::make(2)
                                                ->schema([

                                                    Select::make('company_code_id')
                                                        ->label('Company Code')
                                                        ->inlineLabel()
                                                        ->options(CompanyCode::where('is_active', 1)->pluck('company_code_name', 'id'))
                                                        ->required()
                                                        ->disabled()
                                                        ->dehydrated()
                                                        ->default(1)
                                                        ->native(false),

                                                ]),

                                        ]),

                                    Hidden::make('is_active')
                                        ->default(1),
                                ])
                                ->maxItems(1)
                                ->orderColumn('sort')
                        ]),

                    Tab::make(__('Customer Data'))
                        // ->icon('heroicon-o-list-bullet')
                        ->visible(fn(Get $get) =>
                        in_array('1', $get('bp_role_id')))
                        ->schema([
                            Repeater::make('businessPartnerCustomers')
                                ->label('Customer Data')
                                ->relationship()
                                ->schema([

                                    Fieldset::make('Sales Area Data')
                                        ->schema([

                                            Grid::make(2)
                                                ->schema([

                                                    Select::make('sales_organization_id')
                                                        ->label('Sales Organization')
                                                        ->inlineLabel()
                                                        ->options(SalesOrganization::where('is_active', 1)->pluck('sales_organization_name', 'id'))
                                                        ->required()
                                                        ->disabled()
                                                        ->dehydrated()
                                                        ->default(1)
                                                        ->native(false),

                                                ]),

                                            Grid::make(2)
                                                ->schema([

                                                    Select::make('distribution_channel_id')
                                                        ->label('Distribution Channel')
                                                        ->inlineLabel()
                                                        ->options(DistributionChannel::where('is_active', 1)->pluck('distribution_channel_name', 'id'))
                                                        ->required()
                                                        ->native(false),

                                                ]),

                                            Grid::make(2)
                                                ->schema([

                                                    Select::make('division_id')
                                                        ->label('Division')
                                                        ->inlineLabel()
                                                        ->options(Division::where('is_active', 1)->pluck('division_name', 'id'))
                                                        ->required()
                                                        ->disabled()
                                                        ->dehydrated()
                                                        ->default(4)
                                                        ->native(false),

                                                ]),

                                        ]),

                                    Hidden::make('is_active')
                                        ->default(1),
                                ])
                                ->orderColumn('sort')
                        ]),

                    Tab::make(__('Vendor Data'))
                        // ->icon('heroicon-o-list-bullet')
                        ->visible(fn(Get $get) =>
                        in_array('2', $get('bp_role_id')))
                        ->schema([

                            Repeater::make('businessPartnerVendors')
                                ->label('Vendor Data')
                                ->relationship()
                                ->schema([

                                    Fieldset::make('Purchasing Data')
                                        ->schema([

                                            Grid::make(2)
                                                ->schema([

                                                    Select::make('purchasing_organization_id')
                                                        ->label('Purchasing Organization')
                                                        ->inlineLabel()
                                                        ->options(PurchasingOrganization::where('is_active', 1)->pluck('purchasing_organization_name', 'id'))
                                                        ->required()
                                                        ->disabled()
                                                        ->dehydrated()
                                                        ->default(1)
                                                        ->native(false),

                                                ]),

                                        ]),

                                    Hidden::make('is_active')
                                        ->default(1),
                                ])
                                ->maxItems(1)
                                ->orderColumn('sort')

                        ]),

                ]),

        ];
    }

    // public static function infolist(Infolist $infolist): Infolist
    // {
    //     return $infolist
    //         ->schema([
    //             TextEntry::make('nama'),
    //         ]);
    // }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                ColumnGroup::make('Business Partner', [
                    TextColumn::make('bp_number')
                        ->label('BP Number')
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('name_1')
                        ->label('Name')
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
                        Action::make('nonaktif')
                            ->label('Inactive')
                            ->color('danger')
                            ->icon('heroicon-o-x-circle')
                            ->action(function ($record) {

                                $cekbpcomp = BusinessPartnerCompany::where('business_partner_id', $record->id)->pluck('id')->toArray();
                                $cekbpcust = BusinessPartnerCustomer::where('business_partner_id', $record->id)->pluck('id')->toArray();
                                $cekbpvend = BusinessPartnerVendor::where('business_partner_id', $record->id)->pluck('id')->toArray();

                                // dd($cekbpcomp, $cekbpcust, $cekbpvend);

                                BusinessPartnerCompany::whereIn('id', $cekbpcomp)->update(['is_active' => 0]);

                                BusinessPartnerCustomer::whereIn('id', $cekbpcust)->update(['is_active' => 0]);

                                BusinessPartnerVendor::whereIn('id', $cekbpvend)->update(['is_active' => 0]);

                                $data['is_active'] = 0;
                                $record->update($data);

                                return $record;

                                Notification::make()
                                    ->title('Status Business Partner telah diubah menjadi Inactive')
                                    ->color('danger')
                                    ->send();
                            }),
                        Action::make('aktif')
                            ->label('Activate')
                            ->color('success')
                            ->icon('heroicon-o-check-circle')
                            ->action(function ($record) {

                                $data['is_active'] = 1;
                                $record->update($data);

                                return $record;

                                Notification::make()
                                    ->title('Status Business Partner telah diubah menjadi Active')
                                    ->color('danger')
                                    ->send();
                            }),
                    ])->dropdown(false),
                ]),

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

                Tables\Actions\BulkAction::make('massinactivate')
                    ->label(__('Mass Inactive'))
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalIcon('heroicon-o-x-circle')
                    ->modalIconColor('danger')
                    ->modalHeading('Mass Inactive?')
                    ->modalSubmitActionLabel('Simpan')
                    ->action(
                        function (Collection $records, array $data) {

                            $records->each(
                                function ($record) {

                                    $cekbpcomp = BusinessPartnerCompany::where('business_partner_id', $record->id)->pluck('id')->toArray();
                                    $cekbpcust = BusinessPartnerCustomer::where('business_partner_id', $record->id)->pluck('id')->toArray();
                                    $cekbpvend = BusinessPartnerVendor::where('business_partner_id', $record->id)->pluck('id')->toArray();

                                    // dd($cekbpcomp, $cekbpcust, $cekbpvend);

                                    BusinessPartnerCompany::whereIn('id', $cekbpcomp)->update(['is_active' => 0]);

                                    BusinessPartnerCustomer::whereIn('id', $cekbpcust)->update(['is_active' => 0]);

                                    BusinessPartnerVendor::whereIn('id', $cekbpvend)->update(['is_active' => 0]);

                                    $data['is_active'] = 0;
                                    $record->update($data);
                                    return $record;
                                }
                            );
                        }
                    ),

                Tables\Actions\BulkAction::make('massactivate')
                    ->label(__('Mass Activate'))
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalIcon('heroicon-o-check-circle')
                    ->modalIconColor('success')
                    ->modalHeading('Mass Activate?')
                    ->modalSubmitActionLabel('Simpan')
                    ->form([

                        Checkbox::make('massall')
                            ->label('Also change all Business Partners?'),

                    ])
                    ->action(
                        function (Collection $records, array $data) {

                            // dd($data['massall']);

                            if ($data['massall'] ==  true) {
                                $records->each(
                                    function ($record) {

                                        $cekbpcomp = BusinessPartnerCompany::where('business_partner_id', $record->id)->pluck('id')->toArray();
                                        $cekbpcust = BusinessPartnerCustomer::where('business_partner_id', $record->id)->pluck('id')->toArray();
                                        $cekbpvend = BusinessPartnerVendor::where('business_partner_id', $record->id)->pluck('id')->toArray();

                                        // dd($cekbpcomp, $cekbpcust, $cekbpvend);

                                        BusinessPartnerCompany::whereIn('id', $cekbpcomp)->update(['is_active' => 1]);

                                        BusinessPartnerCustomer::whereIn('id', $cekbpcust)->update(['is_active' => 1]);

                                        BusinessPartnerVendor::whereIn('id', $cekbpvend)->update(['is_active' => 1]);

                                        $data['is_active'] = 1;
                                        $record->update($data);
                                        return $record;
                                    }
                                );
                            } elseif ($data['massall'] ==  false) {
                                $records->each(
                                    function ($record) {

                                        $data['is_active'] = 1;
                                        $record->update($data);
                                        return $record;
                                    }
                                );
                            }
                        }
                    ),

                ExportBulkAction::make()
                    ->label('Export')
                    ->exporter(BusinessPartnerExporter::class)
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // BusinessPartnerCompaniesRelationManager::class,
            // BusinessPartnerCustomersRelationManager::class,
            // BusinessPartnerVendorsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBusinessPartners::route('/'),
            'create' => Pages\CreateBusinessPartner::route('/create'),
            'view' => Pages\ViewBusinessPartner::route('/{record}'),
            'edit' => Pages\EditBusinessPartner::route('/{record}/edit'),
        ];
    }
}
