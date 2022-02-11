import Vue from 'vue'
import axios from 'axios'
import VueAxios from 'vue-axios'
import VueRouter from 'vue-router'
import VueInternationalization from 'vue-i18n';
import Locale from './vue-i18n-locales.generated';
import { ValidationProvider, ValidationObserver, configure, localize } from 'vee-validate';
import en from 'vee-validate/dist/locale/en.json';
import ar from 'vee-validate/dist/locale/ar.json';
import CripLoading from 'crip-vue-loading'
import Circle from './components/loaders/Circle.vue'
import VModal from 'vue-js-modal'
import VueContentLoading from 'vue-content-loading';
import ScrollLoader from 'vue-scroll-loader'
import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-default.css';
import router from './router'
import store from './store'

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

Vue.config.productionTip = false;

window.Vue = require('vue');

// Set Vue localization
Vue.use(VueInternationalization);

const lang = document.documentElement.lang.substr(0, 2);

const i18n = new VueInternationalization({
    locale: lang,
    messages: Locale
});

// Set Vue router
Vue.router = router;
Vue.use(VueRouter);

// Set Vue authentication
Vue.use(VueAxios, axios);
axios.defaults.baseURL = window.location.href.split('/')[0] + 'api';
axios.defaults.withCredentials = true;
axios.interceptors.response.use((response) => {
    return response
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('index-component', require('./components/IndexComponent.vue').default);

// VeeValidator
require('./vee-validator');

Vue.component('validation-observer', ValidationObserver);
Vue.component('validation-provider', ValidationProvider);

// Install English and Arabic locales.
localize({
    en,
    ar
});

localize(lang);

configure({
    classes: {
        valid: 'is-valid',
        invalid: 'is-invalid',
    }
});

// Install component in to Vue instance and inject in to axios.
Vue.use(CripLoading, { axios });

// Loading spinner
Vue.component('loading-spinner', Circle);

// Modals
Vue.use(VModal);

// Vue content placeholder loading
Vue.component('vue-content-loading', VueContentLoading);

// Vue scroll loader
Vue.use(ScrollLoader);

// Vue toast
Vue.use(VueToast);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router,
    i18n,
    store,
});