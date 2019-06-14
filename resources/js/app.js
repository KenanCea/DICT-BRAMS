
require('./bootstrap');
window.Form = Form;
window.Vue = require('vue');

import Vuetify from 'vuetify'
import '@mdi/font/css/materialdesignicons.css'
import colors from 'vuetify/es5/util/colors'
import VueRouter from 'vue-router';
import { routes } from './routes';
import { Form,  HasError, AlertError } from 'vform';
import swal from 'sweetalert2';
window.swal = swal;
import Gate from "./Gate";

Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

Vue.prototype.$gate = new Gate(window.user);

window.Fire = new Vue();
const toast = swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});
window.toast = toast;

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
                error: colors.red
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
        showPassword: false,
        items: [
            {
                src: '/img/dashboard.png',
                class: 'contain'
            },
            { src: '/img/form.png' },
            { src: '/img/household.png' },
            { src: '/img/inhabitant.png' }
        ],
        users: [
            {
                icon: "mdi-view-dashboard",
                title: "Dashboard",
                name: "Dashboard",
                to: "/dashboard",
                meta: { requiuresAuth: true }
            },

            {
                icon: "mdi-home",
                title: "Households",
                name: "Household",
                to: "/households"
            },

            {
                icon: "mdi-printer",
                title: "Print Document",
                name: "Print Document",
                to: "/printdocument"
            },
            {
                icon: "mdi-alpha-k-circle",
                title: "Barangay Kiosk",
                name: "Barangay Kiosk",
                to: "/barangaykiosk"
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
                }, {
                    title: "Households",
                    name: "Households",
                    to: "/archivedHouseholds"
                }
                ]
            },
            { heading: "Unregistered inhabitants" },
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
                },
                ]
            },{
                icon: "mdi-file-document-edit-outline",
                title: "Logs",
                name: "Log History",
                to: "/userLog"
            }
            
        ],
        admins: [
            {
                icon: "mdi-view-dashboard",
                title: "Dashboard",
                name: "Dashboard",
                to: "/admindashboard"
            },
            {
                icon: "mdi-account",
                title: "Users",
                name: "Users",
                to: "/users"
            },
            {
                icon: "mdi-account-remove",
                title: "Archived Users",
                name: "Archived Users",
                to: "/archivedUsers"
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
