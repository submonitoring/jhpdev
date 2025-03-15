<?php

namespace App\Filament\Jhpadmin\Resources;

use App\Filament\Jhpadmin\Clusters\BusinessPartner as ClustersBusinessPartner;
use App\Filament\Jhpadmin\Resources\BusinessPartnerResource\Pages;
use App\Filament\Jhpadmin\Resources\BusinessPartnerResource\RelationManagers;
use App\Filament\Submonitoring\Resources\BusinessPartnerResource as ResourcesBusinessPartnerResource;
use App\Models\BusinessPartner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BusinessPartnerResource extends Resource
{
    protected static ?string $model = BusinessPartner::class;

    // public static function canViewAny(): bool
    // {
    //     return auth()->user()->id == 1;
    // }

    protected static ?string $modelLabel = 'Business Partner';

    protected static ?string $pluralModelLabel = 'Business Partner';

    protected static ?string $navigationLabel = 'Business Partner';

    protected static ?int $navigationSort = 822000000;

    // protected static ?string $navigationIcon = 'heroicon-o-Qisms';

    protected static ?string $cluster = ClustersBusinessPartner::class;

    // protected static ?string $navigationGroup = 'System';

    // protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    // protected static bool $shouldRegisterNavigation = false;

    // public static function shouldRegisterNavigation(): bool
    // {
    //     return false;
    // }

    public static function form(Form $form): Form
    {
        return ResourcesBusinessPartnerResource::form($form);
    }

    public static function table(Table $table): Table
    {
        return ResourcesBusinessPartnerResource::table($table);
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
            'index' => Pages\ListBusinessPartners::route('/'),
            'create' => Pages\CreateBusinessPartner::route('/create'),
            'view' => Pages\ViewBusinessPartner::route('/{record}'),
            'edit' => Pages\EditBusinessPartner::route('/{record}/edit'),
        ];
    }
}
