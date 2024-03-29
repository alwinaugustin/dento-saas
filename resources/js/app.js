import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import PrimeVue from 'primevue/config';
import ConfirmationService from 'primevue/confirmationservice';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Dento';

createInertiaApp({
    title: (title) => `${ title } - ${ appName }`,
    resolve: (name) => resolvePageComponent(name),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(PrimeVue)
            .use(ConfirmationService)
            .use(ZiggyVue, Ziggy)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});

function resolvePageComponent(name) {
    // Check if the name is a module
    let isModule = name.split('::')
    if (isModule.length > 1) {

        // Import pages from the modules folder
        let pages = import.meta.glob(`../../Modules/**/Resources/Pages/*.vue`)

        const findPath = '../../Modules/' + isModule[0]

        const path = Object.keys(pages)
            .find(path =>
                path.startsWith(findPath) && path.endsWith(isModule[1] + '.vue')
            )

        // Throw an error if the page is not found
        if (!path) {
            throw new Error(`Page not found: ${ isModule[1] }`)
        }
        // Return the page
        return typeof pages[path] === 'function' ? pages[path]() : pages[path]

    }

    else {

        // Import pages from the core application folder since it's not a module
        let pages = import.meta.glob('./Pages/**/*.vue')

        // Sort and replace the dot with the correct slash
        const path = Object.keys(pages)
            .sort((a, b) => a.length - b.length)
            .find(path => path.endsWith(`${ name.replaceAll('.', '/') }.vue`))

        // Throw an error if the page is not found
        if (!path) {
            throw new Error(`Page not found: ${ name }`)
        }

        // Return the page
        return typeof pages[path] === 'function' ? pages[path]() : pages[path]
    }
}


