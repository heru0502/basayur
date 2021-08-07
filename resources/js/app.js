import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress'
import { createStore } from 'vuex'
import storeData from './Store/index'
import 'izitoast/dist/css/iziToast.min.css'

InertiaProgress.init({
    color: '#E96A57',
    showSpinner: true,
})

// Create a new store instance.
const store = createStore(
    storeData
)

createInertiaApp({
    resolve: name => require(`./Pages/${name}`),
    setup({ el, app, props, plugin }) {
        createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(store)
            .mount(el)
    },
})
