<?php

namespace App\Filament\Jhpadmin\Resources;

use App\Filament\Jhpadmin\Clusters\BusinessPartner;
use App\Filament\Jhpadmin\Resources\BusinessPartnerVendorResource\Pages;
use App\Filament\Jhpadmin\Resources\BusinessPartnerVendorResource\RelationManagers;
use App\Filament\Submonitoring\Resources\BusinessPartnerVendorResource as ResourcesBusinessPartnerVendorResource;
use App\Models\BusinessPartnerVendor;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BusinessPartnerVendorResource extends Resource
{
    protected static ?string $model = BusinessPartnerVendor::class;

    // public static function canViewAny(): bool
    // {
    //     return auth()->user()->id == 1;
    // }

    protected static ?string $modelLabel = 'Vendor';

    protected static ?string $pluralModelLabel = 'Vendor';

    protected static ?string $navigationLabel = 'Vendor';

    protected static ?int $navigationSort = 822000040;

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
        return ResourcesBusinessPartnerVendorResource::form($form);
    }

    public static function table(Table $table): Table
    {
        return ResourcesBusinessPartnerVendorResource::table($table);
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
            'index' => Pages\ListBusinessPartnerVendors::route('/'),
            'create' => Pages\CreateBusinessPartnerVendor::route('/create'),
            'view' => Pages\ViewBusinessPartnerVendor::route('/{record}'),
            'edit' => Pages\EditBusinessPartnerVendor::route('/{record}/edit'),
        ];
    }
}
