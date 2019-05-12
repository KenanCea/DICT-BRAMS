
require('./bootstrap');
window.Form = Form;

import Vue from 'vue'
import Vuetify from 'vuetify'
import '@mdi/font/css/materialdesignicons.css'
import colors from 'vuetify/es5/util/colors'
import VueRouter from 'vue-router';
import {
    routes
} from './routes';
import {
    Form,
    HasError,
    AlertError
} from 'vform';
import Gate from "./Gate";
Vue.prototype.$gate = new Gate(window.user);
Vue.component(
    'not-found',
    require('./components/403Page.vue').default
);

const opts = {
    icons: {
        iconfont: 'mdi'
    },
    theme: {
        themes: {
            light: {
                primary: colors.blue.darken1,
                secondary: colors.grey.darken1,
                accent: colors.shades.black,
                error: colors.red.accent3
            },
            dark: {
                primary: colors.blue.lighten1
            }
        }
    }
}

Vue.use(Vuetify)

Vue.use(VueRouter)
const router = new VueRouter({
    mode: 'history',
    routes
});


const app = new Vue({
    vuetify: new Vuetify(opts),
    el: '#app',
    router,
    data: () => ({
        drawer: null,
        users: [
            {
                icon: "mdi-view-dashboard",
                title: "Dashboard",
                name: "Dashboard",
                to: "/dashboard"
            },
            {
                icon: "mdi-file-account",
                title: "Forms",
                group: "forms",
                model: false,
                children: [{
                    title: "Barangay Clearance",
                    name: "Barangay Clearance",
                    to: "/barangayclearance"
                },
                {
                    title: "Barangay Certificate",
                    name: "Barangay Certificate",
                    to: "/barangaycertificate"
                },
                {
                    title: "Business Clearance",
                    name: "Business Clearance",
                    to: "/businessclearance"
                },
                {
                    title: "Filed Case",
                    name: "Filed Case",
                    to: "/filedcase"
                }
                ]
            },
            {
                icon: "mdi-home",
                title: "Households",
                name: "Household",
                to: "/households"
            },
            {
                icon: "mdi-account",
                title: "Inhabitants",
                name: "Inhabitants",
                to: "/inhabitants"
            },
            {
                icon: "mdi-content-copy",
                title: "Print Document",
                name: "Print Document",
                to: "/printdocument"
            },
            {
                icon: "mdi-archive",
                title: "Archive",
                group: "Archive",
                model: false,
                children: [{
                    title: "Inhabitant",
                    name: "Inhabitant",
                    to: "/archivedInhabitants"
                },{
                    title: "Households",
                    name: "Households",
                    to: "/archivedHouseholds"
                }
                ]
            },
        ],
        admins: [
            {
                icon: "mdi-view-dashboard",
                title: "Dashboard",
                name: "Dashboard",
                to: "/dashboard"
            },
        ],
        menu: 0,
        menus: [
            {
                icon: "mdi-account-box",
                title: "User Account",
                name: "User Account",
                to: "/useraccount"
            },

            {
                icon: "mdi-map",
                title: "Barangay Information",
                name: "Barangay Information",
                to: "/barangayinformation"
            }
        ],

    })
});
