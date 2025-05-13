<?php

namespace App\Filament\Submonitoring\Resources\AccountDeterminationResource\RelationManagers;

use App\Filament\Submonitoring\Resources\AccountDeterminationItemResource;
use App\Models\AccountDeterminationItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AccountDeterminationItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'accountDeterminationItems';

    public function hasCombinedRelationManagerTabsWithContent(): bool
    {
        return true;
    }

    // use CanBeEmbeddedInModals;

    public static function getNavigationLabel(): string
    {
        return 'Account Determination Items';
    }

    public function form(Form $form): Form
    {
        return AccountDeterminationItemResource::form($form);
    }

    public function table(Table $table): Table
    {
        return AccountDeterminationItemResource::table($table)
            ->recordTitleAttribute('account_determination_id')
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->modalWidth('full'),
            ])
            ->actions([
                ActionGroup::make([
                    ActionGroup::make([
                        Tables\Actions\ViewAction::make(),
                        Tables\Actions\EditAction::make(),
                        Tables\Actions\DeleteAction::make()
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
