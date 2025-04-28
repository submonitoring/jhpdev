<?php

namespace App\Filament\Jhpadmin\Resources;

use App\Filament\Jhpadmin\Resources\BusinessPartnerCompanyResource\Pages;
use App\Filament\Jhpadmin\Resources\BusinessPartnerCompanyResource\RelationManagers;
use App\Models\BusinessPartnerCompany;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BusinessPartnerCompanyResource extends Resource
{
    protected static ?string $model = BusinessPartnerCompany::class;

    public static function canViewAny(): bool
    {
        return auth()->user()->id == 1;
    }

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('unique')
                    ->maxLength(26),
                Forms\Components\TextInput::make('record_title')
                    ->maxLength(255),
                Forms\Components\TextInput::make('sort')
                    ->maxLength(255),
                Forms\Components\TextInput::make('business_partner_id')
                    ->numeric(),
                Forms\Components\TextInput::make('company_code_id')
                    ->numeric(),
                Forms\Components\TextInput::make('cust_account_assignment_group_id')
                    ->numeric(),
                Forms\Components\TextInput::make('cust_tax_classification_id')
                    ->numeric(),
                Forms\Components\TextInput::make('cust_currency_id')
                    ->numeric(),
                Forms\Components\TextInput::make('cust_payment_term_id')
                    ->numeric(),
                Forms\Components\TextInput::make('vend_account_assignment_group_id')
                    ->numeric(),
                Forms\Components\TextInput::make('vend_tax_classification_id')
                    ->numeric(),
                Forms\Components\TextInput::make('vend_currency_id')
                    ->numeric(),
                Forms\Components\TextInput::make('vend_payment_term_id')
                    ->numeric(),
                Forms\Components\Toggle::make('is_active'),
                Forms\Components\TextInput::make('created_by')
                    ->maxLength(255),
                Forms\Components\TextInput::make('updated_by')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('unique')
                    ->searchable(),
                Tables\Columns\TextColumn::make('record_title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sort')
                    ->searchable(),
                Tables\Columns\TextColumn::make('business_partner_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('company_code_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('cust_account_assignment_group_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('cust_tax_classification_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('cust_currency_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('cust_payment_term_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('vend_account_assignment_group_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('vend_tax_classification_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('vend_currency_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('vend_payment_term_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_by')
                    ->searchable(),
                Tables\Columns\TextColumn::make('updated_by')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListBusinessPartnerCompanies::route('/'),
            'create' => Pages\CreateBusinessPartnerCompany::route('/create'),
            'view' => Pages\ViewBusinessPartnerCompany::route('/{record}'),
            'edit' => Pages\EditBusinessPartnerCompany::route('/{record}/edit'),
        ];
    }
}
