import { defineConfig } from "vite";
import { fileURLToPath } from "url";
import { dirname } from "path";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";
import path from "path";
const __dirname = dirname(fileURLToPath(import.meta.url));
export default defineConfig({
    resolve: {
        alias: {
            "@": path.resolve(__dirname, "./resources/js"),
            "@sass": path.resolve(__dirname, "./resources/sass"),
        },
    },
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    css: {
        preprocessorOptions: {
            scss: {
                additionalData: `
                    @import "@sass/01-settings/variables.scss";
                    @import "@sass/01-settings/typography.scss";
                    @import "@sass/02-tools/mixins.scss";
                `,
            },
        },
    },
});
