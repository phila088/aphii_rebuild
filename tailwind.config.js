import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        'node_modules/preline/dist/*.js',
        './resources/sass/app.scss',
        './app/Http/Livewire/**/*Table.php',
        './app/Helpers/PowerGridThemes/TailwindCustom.php',
        './vendor/wire-elements/modal/views/*.blade.php',
        './app/http/Livewire/**/*Table.php',
    ],
    darkMode: ['selector', '[data-theme-mode="dark"]'],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },
    presets: [
        require("./vendor/power-components/livewire-powergrid/tailwind.config.js"),
    ],
    plugins: [
        forms,
        require('preline/plugin'),
    ],
};
