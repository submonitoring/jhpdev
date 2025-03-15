<?php

namespace App\Filament\Submonitoring\Resources;

use App\Filament\Exports\BomHeaderExporter;
use App\Filament\Imports\BomHeaderImporter;
use App\Filament\Submonitoring\Clusters\MaterialBom;
use App\Filament\Submonitoring\Resources\BomHeaderResource\Pages;
use App\Filament\Submonitoring\Resources\BomHeaderResource\RelationManagers;
use App\Models\BomHeader;
use App\Models\MaterialMaster;
use App\Models\Uom;
use Asmit\FilamentMention\Forms\Components\RichMentionEditor;
use Awcodes\TableRepeater\Components\TableRepeater;
use Awcodes\TableRepeater\Header;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
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

class BomHeaderResource extends Resource
{
    protected static ?string $model = BomHeader::class;

    public static function canViewAny(): bool
    {
        return auth()->user()->id == 1;
    }

    protected static ?string $modelLabel = 'BoM Header';

    protected static ?string $pluralModelLabel = 'BoM Header';

    protected static ?string $navigationLabel = 'BoM Header';

    protected static ?int $navigationSort = 826000000;

    // protected static ?string $navigationIcon = 'heroicon-o-Qisms';

    protected static ?string $cluster = MaterialBom::class;

    // protected static ?string $navigationGroup = 'System';

    // protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function form(Form $form): Form
    {
        return $form

            ->schema(static::BoMHeaderFormSchema());
    }

    public static function BoMHeaderFormSchema(): array
    {
        return [

            Section::make('BoM Header')
                ->schema([

                    Grid::make(4)
                        ->schema([

                            // Textarea::make('bom_header_text')
                            //     ->label('BoM Header Text')
                            //     ->required()
                            //     ->unique(BoMHeader::class, ignoreRecord: true),

                            RichMentionEditor::make('bom_header_text')
                                ->columnSpanFull(),

                        ]),

                ])
                ->compact(),

            Section::make('BoM Item')
                ->schema([

                    static::getItemsRepeater(),

                ]),

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

    public static function getItemsRepeater(): Repeater
    {
        return Repeater::make('bomItems')
            ->relationship()
            ->schema([
                Section::make('BoM Item')
                    ->schema([

                        Grid::make(4)
                            ->schema([

                                Select::make('material_master_id')
                                    ->label('Material for Item')
                                    ->required()
                                    ->native(false)
                                    ->options(MaterialMaster::whereIsActive(1)->pluck('material_desc', 'id')),

                            ]),

                    ])
                    ->compact(),

                Section::make('Details')
                    ->schema([

                        Grid::make(4)
                            ->schema([

                                TextInput::make('quantity')
                                    ->label('Quntity')
                                    ->numeric(),

                                Select::make('uom_id')
                                    ->label('UoM')
                                    ->native(false)
                                    ->searchable()
                                    ->options(Uom::whereIsActive(1)->pluck('uom', 'id')),


                            ]),

                        Grid::make(4)
                            ->schema([

                                Textarea::make('bom_item_text')
                                    ->label('BoM Item Text')
                                    ->required(),


                            ]),

                    ])
                    ->compact(),

                Section::make('Item Status')
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
            ])
            ->extraItemActions([])
            ->orderColumn('sort')
            ->defaultItems(1)
            ->hiddenLabel()
            ->collapsed()
            ->itemLabel(fn(array $state): ?string => $state['material_master_id'] ?? null)
            // ->columns([
            //     'md' => 10,
            // ])
            ->required();
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('materialMaster.material_desc')
                    ->label('Material')
                    ->searchable(isIndividual: true, isGlobal: false)
                    ->copyable()
                    ->copyableState(function ($state) {
                        return ($state);
                    })
                    ->copyMessage('Tersalin')
                    ->sortable(),

                ColumnGroup::make('BoM Header', [

                    TextColumn::make('bom_header_text')
                        ->label('BoM Header Text')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable()
                        ->html(),


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

                        TextConstraint::make('material_master_id')
                            ->label('Material Master')
                            ->nullable(),

                        TextConstraint::make('bom_header_text')
                            ->label('BoM Header')
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
                    ->importer(BomHeaderImporter::class)
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
                    ->exporter(BomHeaderExporter::class),

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
            'index' => Pages\ListBomHeaders::route('/'),
            'create' => Pages\CreateBomHeader::route('/create'),
            'view' => Pages\ViewBomHeader::route('/{record}'),
            'edit' => Pages\EditBomHeader::route('/{record}/edit'),
        ];
    }
}
