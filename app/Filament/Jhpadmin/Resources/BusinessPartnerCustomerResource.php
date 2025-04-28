<?php

namespace App\Filament\Jhpadmin\Resources;

use App\Filament\Jhpadmin\Clusters\BusinessPartner;
use App\Filament\Jhpadmin\Resources\BusinessPartnerCustomerResource\Pages;
use App\Filament\Jhpadmin\Resources\BusinessPartnerCustomerResource\RelationManagers;
use App\Filament\Submonitoring\Resources\BusinessPartnerCustomerResource as ResourcesBusinessPartnerCustomerResource;
use App\Models\BusinessPartnerCustomer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BusinessPartnerCustomerResource extends Resource
{
    protected static ?string $model = BusinessPartnerCustomer::class;

    // public static function canViewAny(): bool
    // {
    //     return auth()->user()->id == 1;
    // }

    protected static ?string $modelLabel = 'Customer';

    protected static ?string $pluralModelLabel = 'Customer';

    protected static ?string $navigationLabel = 'Customer';

    protected static ?int $navigationSort = 822000020;

    // protected static ?string $navigationIcon = 'heroicon-o-Qisms';

    protected static ?string $cluster = BusinessPartner::class;

    // protected static ?string $navigationGroup = 'System';

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    // protected static bool $shouldRegisterNavigation = false;

    // public static function shouldRegisterNavigation(): bool
    // {
    //     return false;
    // }

    protected static ?string $recordTitleAttribute = 'record_title';

    public static function form(Form $form): Form
    {
        return ResourcesBusinessPartnerCustomerResource::form($form);
    }

    public static function table(Table $table): Table
    {
        return ResourcesBusinessPartnerCustomerResource::table($table);
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
            'index' => Pages\ListBusinessPartnerCustomers::route('/'),
            'create' => Pages\CreateBusinessPartnerCustomer::route('/create'),
            'view' => Pages\ViewBusinessPartnerCustomer::route('/{record}'),
            'edit' => Pages\EditBusinessPartnerCustomer::route('/{record}/edit'),
        ];
    }
}
