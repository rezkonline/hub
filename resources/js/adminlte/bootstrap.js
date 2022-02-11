import Vue from 'vue'
import axios from 'axios'
import VueAxios from 'vue-axios'
import VueInternationalization from 'vue-i18n'
import Locale from '../vue-i18n-locales.generated'
import ScrollLoader from 'vue-scroll-loader'
import FileUploader from 'laravel-file-uploader'

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

 try {
    window.$ = window.jQuery = require('jquery')
    require('bootstrap')
    require('admin-lte')

    global.moment = require('moment')
    require('daterangepicker')
    require('bootstrap-colorpicker')
    require('select2/dist/js/select2.full')
    require('../echo')
    require('./editor')
    require('./datepicker')
    require('./tagsinput')
} catch (e) {}

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo'

window.Pusher = require('pusher-js');

let PUSHER_APP_KEY = document.head.querySelector('meta[name="PUSHER_APP_KEY"]');
let PUSHER_APP_CLUSTER = document.head.querySelector('meta[name="PUSHER_APP_CLUSTER"]');
let PUSHER_APP_HOST = document.head.querySelector('meta[name="PUSHER_APP_HOST"]');
let PUSHER_APP_PORT = document.head.querySelector('meta[name="PUSHER_APP_PORT"]');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: PUSHER_APP_KEY ? PUSHER_APP_KEY.content : process.env.MIX_PUSHER_APP_KEY,
    cluster: PUSHER_APP_CLUSTER ? PUSHER_APP_CLUSTER.content : process.env.MIX_PUSHER_APP_CLUSTER,
    wsHost: PUSHER_APP_HOST ? PUSHER_APP_HOST.content : process.env.MIX_PUSHER_APP_HOST,
    wsPort: PUSHER_APP_PORT ? PUSHER_APP_PORT.content : process.env.MIX_PUSHER_APP_PORT,
    disableStats: true,
});

window.Vue = require('vue');

Vue.use(VueInternationalization)

const lang = document.documentElement.lang.substr(0, 2)
const i18n = new VueInternationalization({
    locale: lang,
    messages: Locale
})

Vue.use(VueAxios, axios)
Vue.use(ScrollLoader)
Vue.use(FileUploader)

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('select2', require('../components/admin/Select2Component.vue').default);
Vue.component('admin-chat-component', require('../components/admin/AdminChatComponent.vue').default);
Vue.component('admin-notifications-component', require('../components/admin/AdminNotificationsComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    i18n,
});

require('@ahmed-aliraqi/check-all')

CheckAll.onChange(function (el) {
    if (el.checked) {
        el.closest('tr').classList.add("tw-bg-gray-400");
    } else {
        el.closest('tr').classList.remove("tw-bg-gray-400");
    }
});
(function ($) {

    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
    $('#flash-overlay-modal').modal();

    $('.nav-sidebar .nav-treeview .nav-item .active').each((index, el) => {
        $(el).closest('.has-treeview').addClass('menu-open');
    });

})(jQuery);

$(function () {
    var Inputmask = require('inputmask').default;
    // $('.price').mask('9999.999');
    // $(".price").inputmask({ alias : "currency", prefix: '₱ ' });
    Inputmask().mask(document.querySelectorAll("input"));
});