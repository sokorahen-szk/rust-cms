import React from "react";
import { createRoot } from 'react-dom/client';
import { createInertiaApp } from "@inertiajs/inertia-react";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";

if (typeof app !== "undefined") {
    createInertiaApp({
        resolve: (name) =>
            resolvePageComponent(
                `./pages/${name}.jsx`,
                import.meta.glob("./pages/**/*.jsx")
            ),
        setup({ el, App, props }) {
            createRoot(el).render(<App {...props} />)
        },
    });
}
