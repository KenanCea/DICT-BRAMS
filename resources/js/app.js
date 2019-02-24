import Vuetify from 'vuetify'
import colors from 'vuetify/es5/util/colors'
import moment from 'moment';
import VueProgressBar from 'vue-progressbar';
import Gate from "./Gate";
import swal from 'sweetalert2';
import JsonExcel from 'vue-json-excel'
import VueRouter from 'vue-router';
import {
    Form,
    HasError,
    AlertError
} from 'vform';
require('./bootstrap');
window.Vue = require('vue');
window.Form = Form;
Vue.use(Vuetify, {
    theme: {
        primary: colors.blue,
        secondary: colors.grey.darken1,
        accent: colors.shades.black,
        error: colors.red.accent3
    }
})
Vue.prototype.$gate = new Gate(window.user);
window.swal = swal;
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
Vue.component('downloadExcel', JsonExcel)
Vue.use(VueRouter);
let routes = [{
    path: '/home',
    component: require('./components/Home.vue').default
}, {
    path: '/dashboard',
    component: require('./components/Dashboard.vue').default
}, {
    path: '/household',
    component: require('./components/Household.vue').default
}, {
    path: '/inhabitant',
    component: require('./components/Inhabitant.vue').default
},  {
    path: '/calendar',
    component: require('./components/Calendar.vue').default
}, {
    path: '/barangayclearance',
    component: require('./components/Barangayclearance.vue').default
}, {
    path: '/businessclearance',
    component: require('./components/Businessclearance.vue').default
}, {
    path: '/barangaycertificate',
    component: require('./components/Barangaycertificate.vue').default
}, {
    path: '/profile',
    component: require('./components/Profile.vue').default
}, {
    path: '/account',
    component: require('./components/Account.vue').default
}, {
    path: '/api',
    component: require('./components/API.vue').default
}, {
    path: '/createaccount',
    component: require('./components/AccountCreate.vue').default
}, {
    path: '/archivehousehold',
    component: require('./components/ArchiveHousehold.vue').default
}]
Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue').default
);
Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue').default
);
Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue').default
);
Vue.component(
    'vue-layout',
    require('./components/App.vue').default
);
window.Fire = new Vue();
const toast = swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});
window.toast = toast;
const router = new VueRouter({
    mode: 'history',
    routes
});
Vue.use(VueProgressBar, {
    color: '#03A9F4',
    failedColor: 'red',
    thickness: '3px'
});
Vue.filter('uptext', function (text) {
    return text.charAt(0).toUpperCase() + text.slice(1)
});
Vue.filter('myDate', function (created) {
    return moment(created).format('MMMM Do YYYY');
});
const app = new Vue({
    el: '#app',
    router
});