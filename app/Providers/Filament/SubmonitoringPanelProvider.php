<?php

namespace App\Providers\Filament;

use Awcodes\FilamentQuickCreate\QuickCreatePlugin;
use Awcodes\FilamentStickyHeader\StickyHeaderPlugin;
use Awcodes\FilamentVersions\VersionsPlugin;
use Awcodes\FilamentVersions\VersionsWidget;
use Awcodes\LightSwitch\LightSwitchPlugin;
use Awcodes\Overlook\OverlookPlugin;
use Awcodes\Overlook\Widgets\OverlookWidget;
use Awcodes\Recently\RecentlyPlugin;
use Carbon\Carbon;
use CodeWithDennis\FilamentThemeInspector\FilamentThemeInspectorPlugin;
use Devonab\FilamentEasyFooter\EasyFooterPlugin;
use Filament\Actions\Action;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Notifications\Livewire\Notifications;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\MaxWidth;
use Filament\Support\Enums\Alignment;
use Filament\Support\Enums\VerticalAlignment;
use Filament\Widgets;
use Howdu\FilamentRecordSwitcher\FilamentRecordSwitcherPlugin;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Jeffgreco13\FilamentBreezy\BreezyCore;
use Kenepa\Banner\BannerPlugin;
use Kenepa\ResourceLock\ResourceLockPlugin;
use LaraZeus\Delia\DeliaPlugin;
use Niladam\FilamentAutoLogout\AutoLogoutPlugin;
use Njxqlus\FilamentProgressbar\FilamentProgressbarPlugin;
use Orion\FilamentGreeter\GreeterPlugin;
use pxlrbt\FilamentSpotlight\SpotlightPlugin;
use ShuvroRoy\FilamentSpatieLaravelBackup\FilamentSpatieLaravelBackupPlugin;
use ShuvroRoy\FilamentSpatieLaravelHealth\FilamentSpatieLaravelHealthPlugin;
use TomatoPHP\FilamentAlerts\FilamentAlertsPlugin;
use TomatoPHP\FilamentApi\FilamentAPIPlugin;
use TomatoPHP\FilamentArtisan\FilamentArtisanPlugin;
use TomatoPHP\FilamentBookmarksMenu\FilamentBookmarksMenuPlugin;
use TomatoPHP\FilamentBrowser\FilamentBrowserPlugin;
use TomatoPHP\FilamentCms\FilamentCMSPlugin;
use TomatoPHP\FilamentDocs\FilamentDocsPlugin;
use TomatoPHP\FilamentInvoices\FilamentInvoicesPlugin;
use TomatoPHP\FilamentLocations\FilamentLocationsPlugin;
use TomatoPHP\FilamentLogger\FilamentLoggerPlugin;
use TomatoPHP\FilamentMediaManager\FilamentMediaManagerPlugin;
use TomatoPHP\FilamentNotes\Filament\Widgets\NotesWidget;
use TomatoPHP\FilamentNotes\FilamentNotesPlugin;
use TomatoPHP\FilamentSettingsHub\FilamentSettingsHubPlugin;
use TomatoPHP\FilamentSimpleTheme\FilamentSimpleThemePlugin;
use TomatoPHP\FilamentSocial\FilamentSocialPlugin;
use TomatoPHP\FilamentUsers\FilamentUsersPlugin;
use TomatoPHP\FilamentWallet\FilamentWalletPlugin;

class SubmonitoringPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            // ->default()
            ->id('submonitoring')
            ->path('submonitoring')
            // ->login()
            // ->colors([
            //     'primary' => Color::Amber,
            // ])
            ->discoverResources(in: app_path('Filament/Submonitoring/Resources'), for: 'App\\Filament\\Submonitoring\\Resources')
            ->discoverPages(in: app_path('Filament/Submonitoring/Pages'), for: 'App\\Filament\\Submonitoring\\Pages')
            ->discoverClusters(in: app_path('Filament/Submonitoring/Clusters'), for: 'App\\Filament\\Submonitoring\\Clusters')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Submonitoring/Widgets'), for: 'App\\Filament\\Submonitoring\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
                // NotesWidget::class,
                // VersionsWidget::class,
                // OverlookWidget::class,
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
            ])
            ->colors([
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
                SpotlightPlugin::make(),
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
                FilamentSimpleThemePlugin::make(),
                QuickCreatePlugin::make(),
                // StickyHeaderPlugin::make(),
                // ->floating(),
                // VersionsPlugin::make(),
                LightSwitchPlugin::make(),
                // OverlookPlugin::make()
                //     ->sort(2)
                //     ->columns([
                //         'default' => 1,
                //         'sm' => 2,
                //         'md' => 3,
                //         'lg' => 4,
                //         'xl' => 5,
                //         '2xl' => null,
                //     ]),
                // RecentlyPlugin::make(),
                // FilamentThemeInspectorPlugin::make()
                //     ->disabled(fn() => ! app()->hasDebugModeEnabled())
                //     ->toggle(),
                EasyFooterPlugin::make(),
                FilamentRecordSwitcherPlugin::make(),
                // BannerPlugin::make(),
                // DeliaPlugin::make(),
                // AutoLogoutPlugin::make()
                //     ->color(Color::Emerald)                         // Set the color. Defaults to Zinc
                //     // ->disableIf(fn() => auth()->id() === 1)        // Disable the user with ID 1
                //     ->logoutAfter(Carbon::SECONDS_PER_MINUTE * 5)   // Logout the user after 5 minutes
                //     ->withoutWarning()                              // Disable the warning before logging out
                //     ->withoutTimeLeft()                             // Disable the time left
                //     ->timeLeftText('Oh no. Kicking you in...')      // Change the time left text
                //     ->timeLeftText(''),
                FilamentProgressbarPlugin::make()->color('#ef4444'),
                // GreeterPlugin::make()
                //     ->message('Welcome,')
                //     ->name('Admin')
                //     ->title('Selamat datang')
                //     // ->avatar(size: 'w-16 h-16', url: 'https://avatarfiles.alphacoders.com/236/236674.jpg')
                //     ->action(
                //         Action::make('action')
                //             ->label('Visit web')
                //             ->icon('heroicon-o-shopping-cart')
                //             ->url('jhpherbal.com')
                //     )
                //     ->sort(-1)
                //     ->columnSpan('full'),
                // FilamentSpatieLaravelBackupPlugin::make(),
                // FilamentSpatieLaravelHealthPlugin::make(),
                // FilamentAlertsPlugin::make(),
                // FilamentAPIPlugin::make(),
                // FilamentBookmarksMenuPlugin::make(),
                // FilamentBrowserPlugin::make()
                //     ->hiddenFolders([
                //         base_path('app')
                //     ])
                //     ->hiddenFiles([
                //         base_path('.env')
                //     ])
                //     ->hiddenExtantions([
                //         "php"
                //     ])
                //     ->allowCreateFolder()
                //     ->allowEditFile()
                //     ->allowCreateNewFile()
                //     ->allowCreateFolder()
                //     ->allowRenameFile()
                //     ->allowDeleteFile()
                //     ->allowMarkdown()
                //     ->allowCode()
                //     ->allowPreview()
                //     ->basePath(base_path()),
                // FilamentCMSPlugin::make()
                //     ->useCategory()
                //     ->usePost()
                //     ->allowExport()
                //     ->allowImport(),
                // FilamentDocsPlugin::make(),
                // FilamentArtisanPlugin::make(),
                // FilamentInvoicesPlugin::make(),
                // FilamentLocationsPlugin::make(),
                // FilamentLoggerPlugin::make(),
                // FilamentMediaManagerPlugin::make(),
                // \Filament\SpatieLaravelTranslatablePlugin::make()->defaultLocales(['en', 'ar']),
                // \TomatoPHP\FilamentMenus\FilamentMenusPlugin::make(),
                // FilamentNotesPlugin::make(),
                // FilamentSettingsHubPlugin::make()
                //     ->allowSiteSettings()
                //     ->allowSocialMenuSettings(),
                // FilamentSocialPlugin::make()
                //     ->socialLogin()
                //     ->socialRegister(),
                // FilamentUsersPlugin::make(),
                // FilamentWalletPlugin::make(),
            ])
            ->resources([
                config('filament-logger.activity_resource')
            ])
            ->viteTheme('resources/css/filament/submonitoring/theme.css')
            ->bootUsing(function () {
                Notifications::alignment(Alignment::Right);
                Notifications::verticalAlignment(VerticalAlignment::End);
            });
    }
}
