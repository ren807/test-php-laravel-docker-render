import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';
import tsconfigPaths from "vite-tsconfig-paths";

export default defineConfig({
    base: '/build/',
    plugins: [
        laravel({
            input: 'resources/ts/app.tsx',
            refresh: true,
        }),
        react(),
        tsconfigPaths(),
    ],
});
