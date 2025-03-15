<?php

namespace App\Filament\Submonitoring\Resources\BomHeaderResource\RelationManagers;

use App\Filament\Submonitoring\Resources\BomItemResource;
use App\Models\BomItem;
use App\Models\MaterialMaster;
use App\Models\Uom;
use Awcodes\TableRepeater\Components\TableRepeater;
use Awcodes\TableRepeater\Header;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Table;
use Guava\FilamentModalRelationManagers\Concerns\CanBeEmbeddedInModals;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Validation\Rules\Unique;

class BomItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'bomItems';

    use CanBeEmbeddedInModals;

    public static function getNavigationLabel(): string
    {
        return 'Material BoM Items';
    }

    public function form(Form $form): Form
    {
        return $form

            ->schema(static::BoMItemFormSchema());
    }

    public function BoMItemFormSchema(): array
    {
        return [

            Section::make('BoM Item')
                ->schema([

                    Grid::make(4)
                        ->schema([

                            Hidden::make('bom_header_id')
                                ->label('Bom Header')
                                ->default(function ($livewire) {
                                    $bomid = $livewire->getOwnerRecord()->id;

                                    return $bomid;
                                }),

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

    public function table(Table $table): Table
    {
        return BomItemResource::table($table)
            ->recordTitleAttribute('bom_item_text')
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->modalWidth('full'),
            ])
            ->actions([
                ActionGroup::make([
                    ActionGroup::make([
                        Tables\Actions\ViewAction::make()
                            ->modalWidth('full'),
                        Tables\Actions\EditAction::make()
                            ->modalWidth('full'),
                    ])->dropdown(false),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
