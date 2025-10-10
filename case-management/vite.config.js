import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import livewire from "@defstudio/vite-livewire-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/js/app.ts", "resources/css/tailwind.scss"],
            refresh: true,
        }),
        livewire(),
    ],
    css: {
        preprocessorOptions: {
            scss: {
                quietDeps: true, // Disable warning about missing imports
            },
        },
    },
});
