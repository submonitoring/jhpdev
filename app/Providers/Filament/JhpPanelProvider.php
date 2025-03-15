<?php

namespace App\Providers\Filament;

use App\Filament\Auth\Login;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\MaxWidth;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Jeffgreco13\FilamentBreezy\BreezyCore;
use Kenepa\ResourceLock\ResourceLockPlugin;
use LaraZeus\Delia\DeliaPlugin;
use pxlrbt\FilamentSpotlight\SpotlightPlugin;
use TomatoPHP\FilamentSimpleTheme\FilamentSimpleThemePlugin;

class JhpPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->login(Login::class)
            ->id('jhp')
            ->path('')
            // ->colors([
            //     'primary' => Color::Amber,
            // ])
            ->discoverResources(in: app_path('Filament/Jhp/Resources'), for: 'App\\Filament\\Jhp\\Resources')
            ->discoverPages(in: app_path('Filament/Jhp/Pages'), for: 'App\\Filament\\Jhp\\Pages')
            ->discoverClusters(in: app_path('Filament/Jhp/Clusters'), for: 'App\\Filament\\Jhp\\Clusters')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Jhp/Widgets'), for: 'App\\Filament\\Jhp\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                // Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])->colors([
                'danger' => Color::Rose,
                'gray' => Color::Gray,
                'info' => Color::Blue,
                'primary' => Color::Red,
                'success' => Color::Emerald,
                'warning' => Color::Orange,
            ])
            ->font('SF Pro Display')
            ->navigationGroups([

                NavigationGroup::make()
                    ->label('Sales Order')
                    ->icon('heroicon-o-shopping-bag')
                    ->collapsed(),

                NavigationGroup::make()
                    ->label('Organizational Structures')
                    ->icon('heroicon-o-rectangle-group')
                    ->collapsed(),

                NavigationGroup::make()
                    ->label('Material Document')
                    ->icon('heroicon-o-document')
                    ->collapsed(),

                NavigationGroup::make()
                    ->label('Master Data')
                    ->icon('heroicon-o-circle-stack')
                    ->collapsed(),

                NavigationGroup::make()
                    ->label('Basic Settings')
                    ->icon('heroicon-o-wrench')
                    ->collapsed(),

                NavigationGroup::make()
                    ->label('Configuration')
                    ->icon('heroicon-o-adjustments-horizontal')
                    ->collapsed(),

                NavigationGroup::make()
                    ->label('Number Range')
                    ->icon('heroicon-o-numbered-list')
                    ->collapsed(),

                NavigationGroup::make()
                    ->label('System General')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->collapsed(),

                NavigationGroup::make()
                    ->label('System')
                    ->icon('heroicon-o-rectangle-group')
                    ->collapsed(),

                NavigationGroup::make()
                    ->label('Manage Users')
                    ->icon('heroicon-o-user-group')
                    ->collapsed(),

                NavigationGroup::make()
                    ->label('Logs')
                    ->icon('heroicon-o-stop')
                    ->collapsed(),

            ])
            ->sidebarCollapsibleOnDesktop()
            ->unsavedChangesAlerts()
            ->databaseNotifications()
            // ->topNavigation()
            // ->breadcrumbs(false)
            ->maxContentWidth(MaxWidth::Full)
            ->brandLogo(asset('/logojhp/Logo JHP HD.png'))
            ->favicon(asset('favicon-32x32.png'))
            ->brandName('JHP System')
            ->plugins([
                ResourceLockPlugin::make(),
                // SpotlightPlugin::make(),
                \BezhanSalleh\FilamentShield\FilamentShieldPlugin::make(),
                BreezyCore::make()
                    ->myProfile(
                        shouldRegisterUserMenu: true, // Sets the 'account' link in the panel User Menu (default = true)
                        // userMenuLabel: 'My Profile', // Customizes the 'account' link label in the panel User Menu (default = null)
                        shouldRegisterNavigation: false, // Adds a main navigation item for the My Profile page (default = false)
                        navigationGroup: 'Settings', // Sets the navigation group for the My Profile page (default = null)
                        hasAvatars: false, // Enables the avatar upload form component (default = false)
                        slug: 'my-profile' // Sets the slug for the profile page (default = 'my-profile')
                    )
                    ->enableTwoFactorAuthentication(
                        force: false, // force the user to enable 2FA before they can use the application (default = false)
                        // action: CustomTwoFactorPage::class // optionally, use a custom 2FA page
                    ),
                // FilamentSimpleThemePlugin::make()
                DeliaPlugin::make(),
            ])
            ->viteTheme('resources/css/filament/jhp/theme.css');
    }
}
