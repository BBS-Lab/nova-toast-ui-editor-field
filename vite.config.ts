import alias from '@rollup/plugin-alias'
import vue from '@vitejs/plugin-vue'
import { resolve } from 'path'
import { defineConfig } from 'vite'
import tsconfigPaths from 'vite-tsconfig-paths'

export default defineConfig({
    plugins: [
        vue(),
        tsconfigPaths(),
        alias({
            entries: [
                {
                    find: '@',
                    replacement: resolve(__dirname, 'resources/js'),
                },
                {
                    find: '__types__',
                    replacement: resolve(__dirname, 'resources/js/@types'),
                },
            ],
        }),
    ],

    root: resolve(__dirname, 'resources'),

    define: {
        'process.env': process.env, // Vite ditched process.env, so we need to pass it in
    },

    build: {
        outDir: resolve(__dirname, 'dist'),
        emptyOutDir: true,
        target: 'ES2022',
        minify: true,
        manifest: true,
        lib: {
            entry: resolve(__dirname, 'resources/js/field.ts'),
            name: 'field',
            formats: ['umd'],
            fileName: () => 'js/field.js',
        },
        rollupOptions: {
            input: resolve(__dirname, 'resources/js/field.ts'),
            external: ['vue', 'Nova', 'LaravelNova'],
            output: {
                globals: {
                    vue: 'Vue',
                    nova: 'Nova',
                    'laravel-nova': 'LaravelNova',
                },
                assetFileNames: 'css/field.css',
            },
        },
    },

    optimizeDeps: {
        include: ['vue'],
    },
})