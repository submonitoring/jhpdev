<?php

namespace App\Filament\Submonitoring\Resources\MaterialMasterResource\RelationManagers;

use App\Filament\Submonitoring\Resources\BomHeaderResource;
use App\Filament\Submonitoring\Resources\BomHeaderResource\RelationManagers\BomItemsRelationManager;
use App\Models\MaterialMaster;
use App\Models\Uom;
use Awcodes\TableRepeater\Components\TableRepeater;
use Awcodes\TableRepeater\Header;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Table;
use Guava\FilamentModalRelationManagers\Actions\Table\RelationManagerAction;
use Guava\FilamentModalRelationManagers\Concerns\CanBeEmbeddedInModals;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BomHeadersRelationManager extends RelationManager
{
    protected static string $relationship = 'bomHeaders';

    use CanBeEmbeddedInModals;

    public static function getNavigationLabel(): string
    {
        return 'Material BoMs';
    }

    public function form(Form $form): Form
    {
        return BomHeaderResource::form($form);
    }

    public function table(Table $table): Table
    {
        return BomHeaderResource::table($table)
            ->recordTitleAttribute('bom_header_text')
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

                RelationManagerAction::make('bomitem')
                        ->label('BoM Item')
                        ->icon('heroicon-m-queue-list')
                        ->button()
                        ->outlined()
                        ->modalWidth('full')
                        ->modalSubmitActionLabel('Save')
                        ->relationManager(BomItemsRelationManager::make()),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
