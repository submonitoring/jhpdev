<?php

namespace App\Filament\Jhpadmin\Resources;

use App\Filament\Jhpadmin\Resources\ListKebutuhanProduksiResource\Pages;
use App\Filament\Jhpadmin\Resources\ListKebutuhanProduksiResource\RelationManagers;
use App\Filament\Submonitoring\Resources\ListKebutuhanProduksiResource as ResourcesListKebutuhanProduksiResource;
use App\Models\ListKebutuhanProduksi;
use App\Models\MaterialMasterPlant;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ListKebutuhanProduksiResource extends Resource
{
    protected static ?string $model = MaterialMasterPlant::class;

    // public static function canViewAny(): bool
    // {
    //     return auth()->user()->id == 1;
    // }

    protected static ?string $modelLabel = 'List Kebutuhan Produksi';

    protected static ?string $pluralModelLabel = 'List Kebutuhan Produksi';

    protected static ?string $navigationLabel = 'List Kebutuhan Produksi';

    protected static ?int $navigationSort = 812000000;

    // protected static ?string $navigationIcon = 'heroicon-o-Qisms';

    // protected static ?string $cluster = SubmonitoringClustersMaterialDocument::class;

    protected static ?string $navigationGroup = 'Reports';

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    // protected static ?string $recordTitleAttribute = 'record_title';

    public static function form(Form $form): Form
    {
        return ResourcesListKebutuhanProduksiResource::form($form);
    }

    public static function table(Table $table): Table
    {
        return ResourcesListKebutuhanProduksiResource::table($table);
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
            'index' => Pages\ListListKebutuhanProduksis::route('/'),
            'create' => Pages\CreateListKebutuhanProduksi::route('/create'),
            'view' => Pages\ViewListKebutuhanProduksi::route('/{record}'),
            'edit' => Pages\EditListKebutuhanProduksi::route('/{record}/edit'),
        ];
    }
}
