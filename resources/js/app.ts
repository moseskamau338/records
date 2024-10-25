import "../css/app.css";
import "./bootstrap";

import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { createApp, DefineComponent, h } from "vue";
import { createPinia } from "pinia";
import piniaPluginPersistedstate from "pinia-plugin-persistedstate";
import { ZiggyVue } from "../../vendor/tightenco/ziggy";
import { colors } from "@/theme/colors";

const pinia = createPinia();
pinia.use(piniaPluginPersistedstate);

const appName = import.meta.env.VITE_APP_NAME || "RDS";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob<DefineComponent>("./Pages/**/*.vue"),
        ),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(pinia)
            .mount(el);
    },
    progress: {
        // Whether to include the default NProgress styles...
        includeCSS: true,
        // Whether the NProgress spinner will be shown...
        showSpinner: true,
        color: colors.indigo["900"],
    },
});
