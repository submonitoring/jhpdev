<?php

namespace App\Filament\Submonitoring\Resources;

use App\Filament\Exports\ModuleCaaExporter;
use App\Filament\Imports\ModuleCaaImporter;
use App\Filament\Submonitoring\Resources\ModuleCaaResource\Pages;
use App\Filament\Submonitoring\Resources\ModuleCaaResource\RelationManagers;
use App\Models\ModuleBaa;
use App\Models\ModuleCaa;
use App\Models\StatusGroup;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
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
use Filament\Tables\Filters\QueryBuilder\Constraints\SelectConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ModuleCaaResource extends Resource
{
    protected static ?string $model = ModuleCaa::class;

    public static function canViewAny(): bool
    {
        return auth()->user()->id == 1;
    }

    protected static ?string $modelLabel = 'Module Caa';

    protected static ?string $pluralModelLabel = 'Module Caa';

    protected static ?string $navigationLabel = 'Module Caa';

    protected static ?int $navigationSort = 980000140;

    // protected static ?string $navigationIcon = 'heroicon-o-Qisms';

    // protected static ?string $cluster = ConfigGeneral::class;

    protected static ?string $navigationGroup = 'System';

    // protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function form(Form $form): Form
    {
        return $form

            ->schema(static::ModuleCaaFormSchema());
    }

    public static function ModuleCaaFormSchema(): array
    {
        return [

            Section::make('Module Caa')
                ->schema([

                    Grid::make(4)
                        ->schema([

                            TextInput::make('module_caa')
                                ->label('Module Caa')
                                ->required()
                                ->unique(ModuleCaa::class, ignoreRecord: true),

                        ]),

                    Grid::make(4)
                        ->schema([

                            TextInput::make('module_caa_name')
                                ->label('Name')
                                ->required(),

                        ]),

                ])
                ->compact(),

            Section::make('Module Baa')
                ->schema([

                    Grid::make(4)
                        ->schema([

                            ToggleButtons::make('module_baa_id')
                                ->label('Module Baa')
                                ->inline()
                                ->options(ModuleBaa::whereIsActive(1)->pluck('module_baa', 'id'))
                                ->required(),

                        ]),


                ])
                ->compact(),

            Section::make('Status Group')
                ->schema([

                    Grid::make(4)
                        ->schema([

                            Select::make('status_group_id')
                                ->label('Status Status Group')
                                ->native(false)
                                ->options(StatusGroup::whereIsActive(1)->pluck('status_group', 'id')),

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

                ColumnGroup::make('Module Caa', [

                    TextColumn::make('module_caa')
                        ->label('Module Caa')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('module_caa_name')
                        ->label('Name')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                ]),

                ColumnGroup::make('Module Baa', [

                    TextColumn::make('moduleBaa.module_baa')
                        ->label('Module Baa')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                ]),

                ColumnGroup::make('Status Status Group', [

                    TextColumn::make('statusGroup.status_group')
                        ->label('Status Status Group')
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

                        TextConstraint::make('module_caa')
                            ->label('Module Caa')
                            ->nullable(),

                        TextConstraint::make('module_caa_name')
                            ->label('Name')
                            ->nullable(),

                        SelectConstraint::make('status_group_id')
                            ->label('Status Status Group')
                            ->options(StatusGroup::whereIsActive(1)->pluck('status_group', 'id'))
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
                    ->importer(ModuleCaaImporter::class)
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
                    ->exporter(ModuleCaaExporter::class),

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
            'index' => Pages\ListModuleCaas::route('/'),
            'create' => Pages\CreateModuleCaa::route('/create'),
            'view' => Pages\ViewModuleCaa::route('/{record}'),
            'edit' => Pages\EditModuleCaa::route('/{record}/edit'),
        ];
    }
}
