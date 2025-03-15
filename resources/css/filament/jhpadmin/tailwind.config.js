import preset from '../../../../vendor/filament/filament/tailwind.config.preset'

export default {
    presets: [preset],
    content: [
        './app/Filament/Jhpadmin/**/*.php',
        './resources/views/filament/jhpadmin/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
        './vendor/awcodes/filament-table-repeater/resources/**/*.blade.php',
        './vendor/guava/filament-modal-relation-managers/resources/**/*.blade.php',
        './vendor/archilex/filament-toggle-icon-column/**/*.php',
    ],
}
