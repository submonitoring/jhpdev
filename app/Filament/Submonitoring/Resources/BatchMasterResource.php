<?php

namespace App\Filament\Submonitoring\Resources;

use App\Filament\Exports\BatchMasterExporter;
use App\Filament\Imports\BatchMasterImporter;
use App\Filament\Submonitoring\Clusters\Batch;
use App\Filament\Submonitoring\Resources\BatchMasterResource\Pages;
use App\Filament\Submonitoring\Resources\BatchMasterResource\RelationManagers;
use App\Filament\Submonitoring\Resources\BatchMasterResource\RelationManagers\MaterialMastersRelationManager;
use App\Models\BatchMaster;
use App\Models\BatchSource;
use App\Models\BusinessPartner;
use App\Models\NumberRange;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
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
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Resource;
use Filament\Support\Enums\ActionSize;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\ExportBulkAction;
use Filament\Tables\Actions\ImportAction;
use Filament\Tables\Actions\ReplicateAction;
use Filament\Tables\Columns\ColumnGroup;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
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
use Illuminate\Validation\Rules\Unique;
use Schmeits\FilamentCharacterCounter\Forms\Components\Textarea;
use Schmeits\FilamentCharacterCounter\Forms\Components\TextInput;
use Str;

class BatchMasterResource extends Resource
{
    protected static ?string $model = BatchMaster::class;

    public static function canViewAny(): bool
    {
        return auth()->user()->id == 1;
    }

    protected static ?string $modelLabel = 'Batch Master';

    protected static ?string $pluralModelLabel = 'Batch Master';

    protected static ?string $navigationLabel = 'Batch Master';

    protected static ?int $navigationSort = 827000000;

    // protected static ?string $navigationIcon = 'heroicon-o-Qisms';

    protected static ?string $cluster = Batch::class;

    // protected static ?string $navigationGroup = 'System';

    // protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function form(Form $form): Form
    {
        return $form
            ->schema(static::BatchMasterFormSchema());
    }

    public static function BatchMasterFormSchema(): array
    {
        return [

            Section::make('Batch Master')
                ->schema([

                    Grid::make(4)
                        ->schema([

                            Select::make('batch_source_id')
                                ->label('Batch Source')
                                ->required()
                                ->live()
                                ->options(BatchSource::where('is_active', 1)->pluck('batch_source_desc', 'id'))
                                ->disabledOn('edit')
                                ->afterStateUpdated(function (Set $set, $state) {

                                    $getnriid = BatchSource::whereId($state)->first();

                                    if ($state === null) {
                                        return;
                                    } else {

                                        $getisexternal = NumberRange::whereId($getnriid->number_range_id)->first();

                                        $set('is_external', $getisexternal->is_external);
                                    }
                                }),

                            Hidden::make('is_external'),

                        ]),

                ]),

            Section::make('Batch Number')
                ->hidden(fn(Get $get) => $get('batch_source_id') === null)
                ->schema([
                    Grid::make(4)
                        ->schema([

                            TextInput::make('batch_number')
                                ->label('Batch Number')
                                ->unique(BatchMaster::class, ignoreRecord: true)
                                ->disabled(fn(Get $get) => $get('is_external') === 0),

                        ]),

                ]),

            Section::make('Product Data')
                ->hidden(fn(Get $get) => $get('batch_source_id') === null)
                ->schema([
                    Grid::make(4)
                        ->schema([

                            DatePicker::make('production_date')
                                ->label('Production Date'),

                            DatePicker::make('expiration_date')
                                ->label('Expiration Date'),

                        ]),

                ]),

            Section::make('Vendor')
                ->hidden(fn(Get $get) => $get('batch_source_id') == null ||
                    $get('batch_source_id') != 1)
                ->schema([

                    Grid::make(4)
                        ->schema([

                            Select::make('business_partner_id')
                                ->label('Vendor')
                                ->required()
                                ->preload()
                                ->live()
                                ->searchable(['name_1', 'name_4'])
                                ->options(BusinessPartner::where('is_active', 1)->whereJsonContains('bp_role_id', '2')->pluck('name_1', 'id'))
                                ->helperText(function ($state) {

                                    $bp = Businesspartner::whereId($state)->first();

                                    if ($bp == null) {
                                        return;
                                    } elseif ($bp != null) {

                                        return ($bp->title->title_desc . ' ' . $bp->name_1);
                                    }
                                }),

                        ]),
                ]),

            Section::make('Status')
                ->hidden(fn(Get $get) => $get('batch_source_id') === null)
                ->schema([

                    Grid::make(4)
                        ->schema([

                            ToggleButtons::make('is_active')
                                ->label('Active?')
                                ->boolean()
                                ->grouped()
                                ->default(true),

                        ]),
                ]),

        ];
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('batch_number')
                    ->label('Batch Number')
                    ->searchable(isIndividual: true, isGlobal: false)
                    ->copyable()
                    ->copyableState(function ($state) {
                        return ($state);
                    })
                    ->copyMessage('Tersalin')
                    ->sortable(),

                ToggleColumn::make('is_active')
                    ->label('Status')
                    ->sortable(),

                TextColumn::make('created_by')
                    ->label('Created by')
                    ->searchable(isIndividual: true, isGlobal: false)
                    ->copyable()
                    ->copyableState(function ($state) {
                        return ($state);
                    })
                    ->copyMessage('Tersalin')
                    ->sortable(),

                TextColumn::make('updated_by')
                    ->label('Updated by')
                    ->searchable(isIndividual: true, isGlobal: false)
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
            ])
            ->recordUrl(null)
            ->searchOnBlur()
            ->filters([
                QueryBuilder::make()
                    ->constraintPickerColumns(1)
                    ->constraints([

                        TextConstraint::make('material_master')
                            ->label('Batch Master')
                            ->nullable(),

                        TextConstraint::make('material_master_desc')
                            ->label('Description')
                            ->nullable(),

                        BooleanConstraint::make('deletion_flag')
                            ->label('Deletion Flag')
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
                    ->importer(BatchMasterImporter::class),
            ])
            ->actions([
                ActionGroup::make([
                    ActionGroup::make([
                        Tables\Actions\ViewAction::make(),
                        Tables\Actions\EditAction::make(),
                        Tables\Actions\DeleteAction::make(),
                    ])->dropdown(false),
                ]),

                RelationManagerAction::make('mm')
                    ->label('Material Master')
                    ->icon('heroicon-m-arrow-right-end-on-rectangle')
                    ->button()
                    ->outlined()
                    ->modalWidth('full')
                    ->modalSubmitActionLabel('Save')
                    ->relationManager(MaterialMastersRelationManager::make()),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),

                ExportBulkAction::make()
                    ->label('Export')
                    ->exporter(BatchMasterExporter::class)
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
            'index' => Pages\ListBatchMasters::route('/'),
            'create' => Pages\CreateBatchMaster::route('/create'),
            'view' => Pages\ViewBatchMaster::route('/{record}'),
            'edit' => Pages\EditBatchMaster::route('/{record}/edit'),
        ];
    }
}
