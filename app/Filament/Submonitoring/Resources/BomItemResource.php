<?php

namespace App\Filament\Submonitoring\Resources;

use App\Filament\Exports\BomItemExporter;
use App\Filament\Imports\BomItemImporter;
use App\Filament\Submonitoring\Clusters\MaterialBom;
use App\Filament\Submonitoring\Resources\BomItemResource\Pages;
use App\Filament\Submonitoring\Resources\BomItemResource\RelationManagers;
use App\Models\BomItem;
use App\Models\MaterialMaster;
use App\Models\Uom;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
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
use Illuminate\Validation\Rules\Unique;

class BomItemResource extends Resource
{
    protected static ?string $model = BomItem::class;

    public static function canViewAny(): bool
    {
        return auth()->user()->id == 1;
    }

    protected static ?string $modelLabel = 'BoM Item';

    protected static ?string $pluralModelLabel = 'BoM Item';

    protected static ?string $navigationLabel = 'BoM Item';

    protected static ?int $navigationSort = 826000020;

    // protected static ?string $navigationIcon = 'heroicon-o-Qisms';

    protected static ?string $cluster = MaterialBom::class;

    // protected static ?string $navigationGroup = 'System';

    // protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function form(Form $form): Form
    {
        return $form

            ->schema(static::BoMItemFormSchema());
    }

    public static function BoMItemFormSchema(): array
    {
        return [

            Section::make('BoM Item')
                ->schema([

                    Grid::make(4)
                        ->schema([

                            Select::make('material_master_id')
                                ->label('Material for Item')
                                ->required()
                                ->native(false)
                                ->options(MaterialMaster::whereIsActive(1)->pluck('material_desc', 'id'))
                                ->unique(BomItem::class, modifyRuleUsing: function (Unique $rule, Get $get) {

                                    return $rule->where('bom_header_id', $get('bom_header_id'));
                                }, ignoreRecord: true),

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

        ];
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('bomHeader.materialMaster.material_desc')
                    ->label('BoM Header')
                    ->searchable(isIndividual: true, isGlobal: false)
                    ->copyable()
                    ->copyableState(function ($state) {
                        return ($state);
                    })
                    ->copyMessage('Tersalin')
                    ->sortable(),

                TextColumn::make('materialMaster.material_desc')
                    ->label('Material')
                    ->searchable(isIndividual: true, isGlobal: false)
                    ->copyable()
                    ->copyableState(function ($state) {
                        return ($state);
                    })
                    ->copyMessage('Tersalin')
                    ->sortable(),

                ColumnGroup::make('BoM Item', [

                    TextColumn::make('bom_item_text')
                        ->label('BoM Item Text')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),


                ]),

                ColumnGroup::make('Details', [

                    TextColumn::make('quantity')
                        ->label('Quantity')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('uom.uom')
                        ->label('UoM')
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

                        TextConstraint::make('material_master_id')
                            ->label('Material Master')
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
                    ->importer(BomItemImporter::class)
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
                    ->exporter(BomItemExporter::class),

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
            'index' => Pages\ListBomItems::route('/'),
            'create' => Pages\CreateBomItem::route('/create'),
            'view' => Pages\ViewBomItem::route('/{record}'),
            'edit' => Pages\EditBomItem::route('/{record}/edit'),
        ];
    }
}
