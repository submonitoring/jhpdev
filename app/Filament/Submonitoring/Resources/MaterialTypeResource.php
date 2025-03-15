<?php

namespace App\Filament\Submonitoring\Resources;

use App\Filament\Exports\MaterialTypeExporter;
use App\Filament\Imports\MaterialTypeImporter;
use App\Filament\Submonitoring\Clusters\MmBasicSettings;
use App\Filament\Submonitoring\Resources\MaterialTypeResource\Pages;
use App\Filament\Submonitoring\Resources\MaterialTypeResource\RelationManagers;
use App\Models\MaterialType;
use App\Models\NumberRange;
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

class MaterialTypeResource extends Resource
{
    protected static ?string $model = MaterialType::class;

    public static function canViewAny(): bool
    {
        return auth()->user()->id == 1;
    }

    protected static ?string $modelLabel = 'Material Type';

    protected static ?string $pluralModelLabel = 'Material Type';

    protected static ?string $navigationLabel = 'Material Type';

    protected static ?int $navigationSort = 803000000;

    // protected static ?string $navigationIcon = 'heroicon-o-Qisms';

    protected static ?string $cluster = MmBasicSettings::class;

    // protected static ?string $navigationGroup = 'System';

    // protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    protected static ?string $recordTitleAttribute = 'material_type_desc';

    public static function form(Form $form): Form
    {
        return $form

            ->schema(static::MaterialTypeFormSchema());
    }

    public static function MaterialTypeFormSchema(): array
    {
        return [

            Section::make('Material Type')
                ->schema([

                    Grid::make(4)
                        ->schema([

                            TextInput::make('material_type')
                                ->label('Material Type')
                                ->required()
                                ->unique(MaterialType::class, ignoreRecord: true),

                        ]),

                    Grid::make(4)
                        ->schema([

                            TextInput::make('material_type_desc')
                                ->label('Desc')
                                ->required(),

                        ]),

                ])
                ->compact(),

            Section::make('Number Range')
                ->schema([

                    Grid::make(4)
                        ->schema([

                            Select::make('number_range_id')
                                ->label('Number Range')
                                ->options(NumberRange::whereIsActive(1)->pluck('number_range_name', 'id')),

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

                ColumnGroup::make('Material Type', [

                    TextColumn::make('material_type')
                        ->label('Material Type')
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('material_type_desc')
                        ->label('desc')
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                ]),

                ColumnGroup::make('Number Range', [

                    TextColumn::make('numberRange.number_range_name')
                        ->label('Number Range')
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

                        TextConstraint::make('material_type')
                            ->label('Material Type')
                            ->nullable(),

                        TextConstraint::make('material_type_desc')
                            ->label('Desc')
                            ->nullable(),

                        SelectConstraint::make('number_range_id')
                            ->label('Number Range')
                            ->options(NumberRange::whereIsActive(1)->pluck('number_range_name', 'id'))
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
                    ->importer(MaterialTypeImporter::class),
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
                    ->exporter(MaterialTypeExporter::class)
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
            'index' => Pages\ListMaterialTypes::route('/'),
            'create' => Pages\CreateMaterialType::route('/create'),
            'view' => Pages\ViewMaterialType::route('/{record}'),
            'edit' => Pages\EditMaterialType::route('/{record}/edit'),
        ];
    }
}
