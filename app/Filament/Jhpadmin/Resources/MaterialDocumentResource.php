<?php

namespace App\Filament\Jhpadmin\Resources;

use App\Filament\Jhpadmin\Clusters\MaterialDocument as ClustersMaterialDocument;
use App\Filament\Jhpadmin\Resources\MaterialDocumentResource\Pages;
use App\Filament\Jhpadmin\Resources\MaterialDocumentResource\RelationManagers;
use App\Filament\Submonitoring\Resources\MaterialDocumentResource as ResourcesMaterialDocumentResource;
use App\Models\MaterialDocument;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MaterialDocumentResource extends Resource
{
    protected static ?string $model = MaterialDocument::class;

    // public static function canViewAny(): bool
    // {
    //     return auth()->user()->id == 1;
    // }

    protected static ?string $modelLabel = 'Material Document';

    protected static ?string $pluralModelLabel = 'Material Document';

    protected static ?string $navigationLabel = 'Material Document';

    protected static ?int $navigationSort = 822000000;

    // protected static ?string $navigationIcon = 'heroicon-o-Qisms';

    protected static ?string $cluster = ClustersMaterialDocument::class;

    // protected static ?string $navigationGroup = 'System';

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    protected static ?string $recordTitleAttribute = 'record_title';

    public static function form(Form $form): Form
    {
        return ResourcesMaterialDocumentResource::form($form);
    }

    public static function table(Table $table): Table
    {
        return ResourcesMaterialDocumentResource::table($table);
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
            'index' => Pages\ListMaterialDocuments::route('/'),
            'create' => Pages\CreateMaterialDocument::route('/create'),
            'view' => Pages\ViewMaterialDocument::route('/{record}'),
            'edit' => Pages\EditMaterialDocument::route('/{record}/edit'),
        ];
    }
}
