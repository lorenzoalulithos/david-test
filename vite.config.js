import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite'


export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        host: '0.0.0.0',   // listen on all container interfaces
        port: 5173,        // internal port
        strictPort: true,
        https: false,      // DDEV handles HTTPS
        hmr: {
            '',          // browser connects using the DDEV domain
            protocol: 'ws',
        },
    },
});
