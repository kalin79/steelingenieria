import "./bootstrap";
import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import "../sass/app.scss"; // Importa SASS aquí
const appName = import.meta.env.VITE_APP_NAME || "App";

createInertiaApp({
    // title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue"),
        ),
    setup({ el, App, props }) {
        createApp({ render: () => h(App, props) }).mount(el);
    },
    progress: {
        color: "#4B5563",
    },
});
