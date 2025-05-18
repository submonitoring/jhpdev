<?php

namespace App\Filament\Jhpadmin\Resources;

use App\Filament\Jhpadmin\Clusters\MaterialMaster;
use App\Filament\Jhpadmin\Resources\MaterialMasterSalesResource\Pages;
use App\Filament\Jhpadmin\Resources\MaterialMasterSalesResource\RelationManagers;
use App\Filament\Submonitoring\Resources\MaterialMasterSalesResource as ResourcesMaterialMasterSalesResource;
use App\Models\MaterialMasterSales;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MaterialMasterSalesResource extends Resource
{
    protected static ?string $model = MaterialMasterSales::class;

    // public static function canViewAny(): bool
    // {
    //     return auth()->user()->id == 1;
    // }

    protected static ?string $modelLabel = 'Material Master Sales';

    protected static ?string $pluralModelLabel = 'Material Master Sales';

    protected static ?string $navigationLabel = 'Material Master Sales';

    protected static ?int $navigationSort = 834000040;

    // protected static ?string $navigationIcon = 'heroicon-o-Qisms';

    protected static ?string $cluster = MaterialMaster::class;

    // protected static ?string $navigationGroup = 'System';

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    protected static ?string $recordTitleAttribute = 'record_title';

    public static function form(Form $form): Form
    {
        return ResourcesMaterialMasterSalesResource::form($form);
    }

    public static function table(Table $table): Table
    {
        return ResourcesMaterialMasterSalesResource::table($table);
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
            'index' => Pages\ListMaterialMasterSales::route('/'),
            'create' => Pages\CreateMaterialMasterSales::route('/create'),
            'view' => Pages\ViewMaterialMasterSales::route('/{record}'),
            'edit' => Pages\EditMaterialMasterSales::route('/{record}/edit'),
        ];
    }
}
