import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    // Configuration required when using a Docker container
    server: {
        host: '0.0.0.0',
        port: 5173,
        strictPort: true,
        hmr: {
            host: 'localhost',
            protocol: 'ws',
            // Add timeout to prevent hanging connections
            timeout: 60000,
        },
        // Improve file watching
        watch: {
            usePolling: true,
            interval: 1000,
        },
        // Increase memory limit
        fs: {
            strict: false,
        }
    },
    build: {
        // Minimize CSS in production
        cssMinify: true,
        // Improve chunk loading
        chunkSizeWarningLimit: 1000,
    },
});
