import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite'

export default defineConfig({
    plugins: [
        laravel([
            'resources/assets/css/style.css',
            'resources/assets/js/script.js',
        ]),
        tailwindcss(),
    ],
    resolve: {
        alias: {
            '@': '/resources/assets',
        },
    },
});