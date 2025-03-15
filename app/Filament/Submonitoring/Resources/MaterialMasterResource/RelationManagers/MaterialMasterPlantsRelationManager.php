<?php

namespace App\Filament\Submonitoring\Resources\MaterialMasterResource\RelationManagers;

use App\Filament\Submonitoring\Resources\MaterialMasterPlantResource;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Table;
use Guava\FilamentModalRelationManagers\Concerns\CanBeEmbeddedInModals;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MaterialMasterPlantsRelationManager extends RelationManager
{
    protected static string $relationship = 'materialMasterPlants';

    use CanBeEmbeddedInModals;

    public static function getNavigationLabel(): string
    {
        return 'Material Plants';
    }

    public function form(Form $form): Form
    {
        return MaterialMasterPlantResource::form($form);
    }

    public function table(Table $table): Table
    {
        return MaterialMasterPlantResource::table($table)
            ->recordTitleAttribute('plant_id')
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->modalWidth('full'),
            ])
            ->actions([
                ActionGroup::make([
                    ActionGroup::make([
                        Tables\Actions\ViewAction::make(),
                        Tables\Actions\EditAction::make(),
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
