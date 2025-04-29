import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel([
            'resources/assets/css/style.css',
            'resources/assets/js/script.js',
        ]),
    ],
    resolve: {
        alias: {
            '@': '/resources/assets',
        },
    },
});