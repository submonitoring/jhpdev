import preset from '../../../../vendor/filament/filament/tailwind.config.preset'

export default {
    presets: [preset],
    content: [
        './app/Filament/Submonitoring/**/*.php',
        './resources/views/filament/submonitoring/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
        './vendor/awcodes/filament-table-repeater/resources/**/*.blade.php',
        './vendor/guava/filament-modal-relation-managers/resources/**/*.blade.php',
        './vendor/archilex/filament-toggle-icon-column/**/*.php',
        './vendor/awcodes/filament-badgeable-column/resources/**/*.blade.php',
        './vendor/awcodes/filament-quick-create/resources/**/*.blade.php',
        './vendor/awcodes/filament-versions/resources/**/*.blade.php',
        // './vendor/awcodes/overlook/resources/**/*.blade.php',
        './vendor/awcodes/recently/resources/**/*.blade.php',
        './vendor/codewithdennis/filament-simple-alert/resources/**/*.blade.php',
        './vendor/kenepa/banner/resources/**/*.php',
        './vendor/lara-zeus/accordion/resources/views/**/*.blade.php',
        './vendor/lara-zeus/matrix-choice/resources/views/**/*.blade.php',
        './vendor/guava/calendar/resources/**/*.blade.php',
    ],
}
