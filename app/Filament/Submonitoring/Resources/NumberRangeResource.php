<?php

namespace App\Filament\Submonitoring\Resources;

use App\Filament\Exports\NumberRangeExporter;
use App\Filament\Imports\NumberRangeImporter;
use App\Filament\Submonitoring\Clusters\NumberRange as ClustersNumberRange;
use App\Filament\Submonitoring\Resources\NumberRangeResource\Pages;
use App\Filament\Submonitoring\Resources\NumberRangeResource\RelationManagers;
use App\Models\NrObject;
use App\Models\NumberRange;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
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
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Schmeits\FilamentCharacterCounter\Forms\Components\TextInput;

class NumberRangeResource extends Resource
{
    protected static ?string $model = NumberRange::class;

    public static function canViewAny(): bool
    {
        return auth()->user()->id == 1;
    }

    protected static ?string $modelLabel = 'Number Range';

    protected static ?string $pluralModelLabel = 'Number Range';

    protected static ?string $navigationLabel = 'Number Range';

    protected static ?int $navigationSort = 960000020;

    // protected static ?string $navigationIcon = 'heroicon-o-Qisms';

    protected static ?string $cluster = ClustersNumberRange::class;

    protected static ?string $navigationParentItem = 'Nr Object';

    // protected static ?string $navigationGroup = 'Number Range';

    // protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function form(Form $form): Form
    {
        return $form
            ->schema(static::NumbeRangesFormSchema());
    }

    public static function NumbeRangesFormSchema(): array
    {
        return [

            Section::make()
                ->schema([

                    Grid::make(2)
                        ->schema([

                            Select::make('nr_object_id')
                                ->label('Nr Object')
                                ->required()
                                ->native(false)
                                ->options(NrObject::whereIsActive(1)->pluck('nr_object', 'id')),


                        ]),

                    Grid::make(2)
                        ->schema([

                            TextInput::make('number_range_interval')
                                ->label('Interval Code')
                                ->required()
                                ->inlineLabel()
                                ->unique(NumberRange::class, ignoreRecord: true),

                        ]),

                    Grid::make(2)
                        ->schema([

                            TextInput::make('number_range_name')
                                ->label('Name')
                                ->required()
                                ->inlineLabel(),

                        ]),

                    Grid::make(2)
                        ->schema([

                            ToggleButtons::make('is_external')
                                ->label('External?')
                                ->boolean()
                                ->inline()
                                ->live()
                                ->required(),

                        ]),

                    Grid::make(2)
                        ->hidden(fn(Get $get) => $get('is_external') == true)
                        ->schema([

                            TextInput::make('year')
                                ->label('Year')
                                ->numeric()
                                ->inlineLabel()
                                ->maxLength(4)
                                ->characterLimit(4)

                        ]),

                    Grid::make(2)
                        ->hidden(fn(Get $get) => $get('is_external') == true)
                        ->schema([

                            TextInput::make('number')
                                ->label('Number Range')
                                ->numeric()
                                ->required()
                                ->inlineLabel()
                                ->maxLength(10)
                                ->characterLimit(10),

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

                ColumnGroup::make('Name and Interval', [

                    TextColumn::make('nrObject.nr_object_name')
                        ->label('Nr Object')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('number_range_interval')
                        ->label('NR Interval')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('number_range_name')
                        ->label('Name')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                ]),

                ColumnGroup::make('Year', [

                    TextColumn::make('year')
                        ->label('Year')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                ]),

                ColumnGroup::make('Number Status', [

                    TextColumn::make('number')
                        ->label('Number Range')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('current_number')
                        ->label('Current Number')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                ]),

                ColumnGroup::make('External?', [

                    CheckboxColumn::make('is_external')
                        ->label('External?')
                        ->sortable(),

                ]),

                ColumnGroup::make('Status', [

                    CheckboxColumn::make('is_active')
                        ->label('Status')
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
            ->extremePaginationLinks()
            ->searchOnBlur()
            ->filters([
                QueryBuilder::make()
                    ->constraintPickerColumns(1)
                    ->constraints([

                        TextConstraint::make('number_range_interval')
                            ->label('Interval')
                            ->nullable(),

                        TextConstraint::make('number_range_name')
                            ->label('Name')
                            ->nullable(),

                        BooleanConstraint::make('is_external'),

                        BooleanConstraint::make('is_active'),

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
                Tables\Actions\CreateAction::make(),

                ImportAction::make()
                    ->label('Import')
                    ->importer(NumberRangeImporter::class),
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
                    ->exporter(NumberRangeExporter::class)
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
            'index' => Pages\ListNumberRanges::route('/'),
            'create' => Pages\CreateNumberRange::route('/create'),
            'view' => Pages\ViewNumberRange::route('/{record}'),
            'edit' => Pages\EditNumberRange::route('/{record}/edit'),
        ];
    }
}
