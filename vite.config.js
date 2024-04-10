import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { viteStaticCopy } from 'vite-plugin-static-copy';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/scss/styles.scss',
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/libs/custom/custom-switcher.js',
                'resources/libs/custom/defaultmenu.js',
            ],
            refresh: true,
        }),
        viteStaticCopy({
            targets: [
                {
                    src: ([
                        'resources/icon-fonts',
                        'resources/img/',
                        'resources/libs/'
                    ]),
                    dest: 'assets/'
                }
            ],
        }),
    ],
});
