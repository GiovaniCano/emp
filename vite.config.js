import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
// import { fileURLToPath, URL } from 'node:url'

export default defineConfig({
    server: {
        host: '0.0.0.0',
        hmr: {
            host: 'localhost'
        }
    },
    css: {
        devSourcemap: true,
    },
    build: {
        sourcemap: true,
    },
    plugins: [
        laravel({
            input: ['resources/scss/app.scss', 'resources/js/app.js', 'resources/vue/app.js'],
            refresh: true,
        }),
        vue(),
    ],
    // resolve: {
    //   alias: {
    //     '@': fileURLToPath(new URL('./src', import.meta.url))
    //   }
    // }
});
