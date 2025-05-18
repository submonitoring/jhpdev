<?php

namespace App\Filament\Jhpadmin\Resources;

use App\Filament\Jhpadmin\Clusters\MaterialMaster as ClustersMaterialMaster;
use App\Filament\Jhpadmin\Resources\MaterialMasterResource\Pages;
use App\Filament\Jhpadmin\Resources\MaterialMasterResource\RelationManagers;
use App\Filament\Submonitoring\Resources\MaterialMasterResource as ResourcesMaterialMasterResource;
use App\Models\MaterialMaster;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MaterialMasterResource extends Resource
{
    protected static ?string $model = MaterialMaster::class;

    // public static function canViewAny(): bool
    // {
    //     return auth()->user()->id == 1;
    // }

    protected static ?string $modelLabel = 'Material Master';

    protected static ?string $pluralModelLabel = 'Material Master';

    protected static ?string $navigationLabel = 'Material Master';

    protected static ?int $navigationSort = 834000000;

    // protected static ?string $navigationIcon = 'heroicon-o-Qisms';

    protected static ?string $cluster = ClustersMaterialMaster::class;

    // protected static ?string $navigationGroup = 'System';

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    protected static ?string $recordTitleAttribute = 'record_title';

    public static function form(Form $form): Form
    {
        return ResourcesMaterialMasterResource::form($form);
    }

    public static function table(Table $table): Table
    {
        return ResourcesMaterialMasterResource::table($table);
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
            'index' => Pages\ListMaterialMasters::route('/'),
            'create' => Pages\CreateMaterialMaster::route('/create'),
            'view' => Pages\ViewMaterialMaster::route('/{record}'),
            'edit' => Pages\EditMaterialMaster::route('/{record}/edit'),
        ];
    }
}
