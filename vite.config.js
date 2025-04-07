import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
		'resources/css/app.css',
                'resources/css/main.css',
                'resources/css/output.css',
                'resources/js/app.js',
		'resources/js/take.js',
            ],
            refresh: true,
        }),
    ],
});
