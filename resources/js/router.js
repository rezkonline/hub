import VueRouter from 'vue-router'

// Pages
import App from "./components/pages/App";
import IndexDashboard from "./components/dashboard/IndexDashboard";
import ChatComponent from "./components/dashboard/ChatComponent";
import AccountComponent from "./components/dashboard/AccountComponent";
import SettingsComponent from "./components/dashboard/SettingsComponent";

// Routes
const routes = [
    {
        path: '/',
        component: App,
        children: [
            {
                path: 'chat',
                name: 'chat',
                component: ChatComponent,
                meta: {
                    auth: true,
                    title: 'frontend.menus.chat',
                }
            },
            {
                path: 'account',
                name: 'account',
                component: AccountComponent,
                meta: {
                    auth: true,
                    title: 'frontend.menus.account',
                }
            },
            {
                path: 'settings',
                name: 'settings',
                component: SettingsComponent,
                meta: {
                    auth: true,
                    title: 'frontend.menus.settings',
                }
            },
            {
                path: ':type?',
                name: 'app',
                component: IndexDashboard,
                meta: {
                    auth: true,
                    title: 'frontend.menus.dashboard',
                },
            },
        ]
    }
];

const router = new VueRouter({
    history: true,
    mode: 'history',
    routes,
});

// This callback runs before every route change, including on page load.
router.beforeEach(async (to, from, next) => {
    // This goes through the matched routes from last to first, finding the closest route with a title.
    // eg. if we have /some/deep/nested/route and /some, /deep, and /nested have titles, nested's will be chosen.
    const nearestWithTitle = to.matched.slice().reverse().find(r => r.meta && r.meta.title);

    // Find the nearest route element with meta tags.
    const nearestWithMeta = to.matched.slice().reverse().find(r => r.meta && r.meta.metaTags);

    // If a route with a title was found, set the document (page) title to that value.
    if (nearestWithTitle && to.path !== '/login') {
        var title = document.title;
        var n = title.indexOf(' | ');
        document.title = document.title.substring(0, n !== -1 ? n : title.length) + ' | ' + router.app.$t(nearestWithTitle.meta.title);
    }

    // Remove any stale meta tags from the document using the key attribute we set below.
    Array.from(document.querySelectorAll('[data-vue-router-controlled]')).map(el => el.parentNode.removeChild(el));

    // Skip rendering meta tags if there are none.
    if(!nearestWithMeta) return next();

    // Turn the meta tag definitions into actual elements in the head.
    nearestWithMeta.meta.metaTags.map(tagDef => {
        const tag = document.createElement('meta');

        Object.keys(tagDef).forEach(key => {
            tag.setAttribute(key, tagDef[key]);
        });

        // We use this to track which meta tags we create, so we don't interfere with other ones.
        tag.setAttribute('data-vue-router-controlled', '');

        return tag;
    }).forEach(tag => document.head.appendChild(tag));

    next();
});

export default router
