import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/js/app.js", "resources/sass/app.scss"],
            refresh: true,
        }),
    ],
    css: {
        preprocessorOptions: {
            scss: {
                quietDeps: true, // Disable warning about missing imports
            },
        },
    },
});
