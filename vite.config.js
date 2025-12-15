import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'
import svgLoader from 'vite-svg-loader';
export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js','resources/js/app-lte.js'],
            refresh: [
                'routes/**',
                'resources/views/**',
                // 'resources/js/**',
            ],
        }),
        svgLoader()
    ],

});
