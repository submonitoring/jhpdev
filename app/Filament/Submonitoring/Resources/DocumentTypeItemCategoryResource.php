<?php

namespace App\Filament\Submonitoring\Resources;

use App\Filament\Exports\DocumentTypeItemCategoryExporter;
use App\Filament\Submonitoring\Resources\DocumentTypeItemCategoryResource\Pages;
use App\Filament\Submonitoring\Resources\DocumentTypeItemCategoryResource\RelationManagers;
use App\Models\DocumentType;
use App\Models\DocumentTypeItemCategory;
use App\Models\ItemCategory;
use Filament\Forms;
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
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\BulkAction;
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
use Illuminate\Support\Collection;
use Illuminate\Validation\Rules\Unique;

class DocumentTypeItemCategoryResource extends Resource
{
    protected static ?string $model = DocumentTypeItemCategory::class;

    public static function canViewAny(): bool
    {
        return auth()->user()->id == 1;
    }

    protected static ?string $modelLabel = 'Document Type Item Category';

    protected static ?string $pluralModelLabel = 'Document Type Item Category';

    protected static ?string $navigationLabel = 'Document Type Item Category';

    protected static ?int $navigationSort = 940000220;

    // protected static ?string $navigationIcon = 'heroicon-o-Qisms';

    // protected static ?string $cluster = FIGeneralLedger::class;

    protected static ?string $navigationGroup = 'System';

    // protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function form(Form $form): Form
    {
        return $form

            ->schema(static::DocumentTypeItemCategoryFormSchema());
    }

    public static function DocumentTypeItemCategoryFormSchema(): array
    {
        return [];
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                ColumnGroup::make('Document Type Item Category', [

                    TextColumn::make('documentType.document_type_desc')
                        ->label('Document Type')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('itemCategory.item_category_desc')
                        ->label('Item Category')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),
                ]),

                ColumnGroup::make('Status', [

                    CheckboxColumn::make('isactive')
                        ->label('Status')
                        ->sortable()
                        ->alignCenter(),
                ]),

            ])
            ->recordUrl(null)
            ->searchOnBlur()
            ->filters([
                QueryBuilder::make()
                    ->constraintPickerColumns(1)
                    ->constraints([

                        SelectConstraint::make('document_type_id')
                            ->label('Document Type')
                            ->options(DocumentType::whereIsActive(1)->pluck('document_type_desc', 'id'))
                            ->icon(false)
                            ->nullable(),

                        SelectConstraint::make('item_category_id')
                            ->label('Item Category')
                            ->options(ItemCategory::whereIsActive(1)->pluck('item_category_desc', 'id'))
                            ->icon(false)
                            ->nullable(),

                        BooleanConstraint::make('isactive')
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
                // Tables\Actions\CreateAction::make(),

                // ImportAction::make()
                //     ->label('Import')
                //     ->importer(DocumentTypeItemCategoryImporter::class)
            ])
            ->actions([
                // ActionGroup::make([
                //     ActionGroup::make([
                //         Tables\Actions\ViewAction::make(),
                //         Tables\Actions\DetachAction::make(),
                //         Tables\Actions\EditAction::make(),
                //     ])->dropdown(false),

                // ]),

            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),

                ExportBulkAction::make()
                    ->label('Export')
                    ->exporter(DocumentTypeItemCategoryExporter::class),

                BulkAction::make('setactive')
                    ->label(__('Set Active'))
                    ->color('success')
                    // ->visible(fn($livewire): bool => $livewire->activeTab === 'Aktif')
                    // ->requiresConfirmation()
                    // ->modalIcon('heroicon-o-check-circle')
                    // ->modalIconColor('success')
                    // ->modalHeading('Simpan data santri tinggal kelas?')
                    // ->modalDescription('Setelah klik tombol "Simpan", maka status akan berubah')
                    // ->modalSubmitActionLabel('Simpan')
                    ->action(fn(Collection $records, array $data) => $records->each(
                        function ($record) {

                            $active = DocumentTypeItemCategory::where('id', $record->id)->first();
                            $active->isactive = 1;
                            $active->save();

                            Notification::make()
                                ->success()
                                ->title('Status telah diupdate')
                                ->icon('heroicon-o-check-circle')
                                // ->persistent()
                                ->color('Success')
                                // ->actions([
                                //     Action::make('view')
                                //         ->button(),
                                //     Action::make('undo')
                                //         ->color('secondary'),
                                // ])
                                ->send();
                        }
                    ))
                    ->deselectRecordsAfterCompletion(),

                BulkAction::make('setinactive')
                    ->label(__('Set Inactive'))
                    ->color('danger')
                    // ->visible(fn($livewire): bool => $livewire->activeTab === 'Aktif')
                    // ->requiresConfirmation()
                    // ->modalIcon('heroicon-o-check-circle')
                    // ->modalIconColor('success')
                    // ->modalHeading('Simpan data santri tinggal kelas?')
                    // ->modalDescription('Setelah klik tombol "Simpan", maka status akan berubah')
                    // ->modalSubmitActionLabel('Simpan')
                    ->action(fn(Collection $records, array $data) => $records->each(
                        function ($record) {

                            $inactive = DocumentTypeItemCategory::where('id', $record->id)->first();
                            $inactive->isactive = 0;
                            $inactive->save();

                            Notification::make()
                                ->success()
                                ->title('Status telah diupdate')
                                ->icon('heroicon-o-check-circle')
                                // ->persistent()
                                ->color('Success')
                                // ->actions([
                                //     Action::make('view')
                                //         ->button(),
                                //     Action::make('undo')
                                //         ->color('secondary'),
                                // ])
                                ->send();
                        }
                    ))
                    ->deselectRecordsAfterCompletion(),

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
            'index' => Pages\ListDocumentTypeItemCategories::route('/'),
            'create' => Pages\CreateDocumentTypeItemCategory::route('/create'),
            'view' => Pages\ViewDocumentTypeItemCategory::route('/{record}'),
            'edit' => Pages\EditDocumentTypeItemCategory::route('/{record}/edit'),
        ];
    }
}
