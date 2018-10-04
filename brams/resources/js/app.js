require('./bootstrap');
window.Vue = require('vue');
window.Form = Form;
import moment from 'moment';
import VueProgressBar from 'vue-progressbar';
import {
    Form,
    HasError,
    AlertError
} from 'vform';

import swal from 'sweetalert2';
window.swal = swal;

Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);

import VueRouter from 'vue-router';
Vue.use(VueRouter);
let routes = [
    {
        path: '/home',
        component: require('./components/Home.vue')
    }
    , {
        path: '/dashboard',
        component: require('./components/Dashboard.vue')
    }
    , {
        path: '/household',
        component: require('./components/Household.vue')
    }
    , {
        path: '/inhabitant',
        component: require('./components/Inhabitant.vue')
    }
    , {
        path: '/pet',
        component: require('./components/Pet.vue')
    }
    , {
        path: '/garbage',
        component: require('./components/Garbage.vue')
    }
    , {
        path: '/calendar',
        component: require('./components/Calendar.vue')
    }
    , {
        path: '/barangayclearance',
        component: require('./components/Barangayclearance.vue')
    }
    , {
        path: '/businessclearance',
        component: require('./components/Businessclearance.vue')
    }
    , {
        path: '/barangaycertificate',
        component: require('./components/Barangaycertificate.vue')
    }
    , {
        path: '/garagecertificate',
        component: require('./components/Garagecertificate.vue')
    }
    , {
        path: '/barangayidcard',
        component: require('./components/Barangayidcard.vue')
    }
    , {
        path: '/filedcase',
        component: require('./components/Filedcase.vue')
    }
    , {
        path: '/resolutions',
        component: require('./components/Resolutions.vue')
    }
    , {
        path: '/memorandum',
        component: require('./components/Memorandum.vue')
    }
    , {
        path: '/minofmeeting',
        component: require('./components/Minofmeeting.vue')
    }
    , {
        path: '/ecologicalprofileform',
        component: require('./components/Ecologicalprofileform.vue')
    }
    , {
        path: '/barangayclearancelist',
        component: require('./components/Barangayclearancelist.vue')
    }
    , {
        path: '/businessclearancelist',
        component: require('./components/Businessclearancelist.vue')
    }
    , {
        path: '/certification',
        component: require('./components/Certification.vue')
    }
    , {
        path: '/profile',
        component: require('./components/Profile.vue')
    }
    , {
        path: '/profilefull',
        component: require('./components/Profilefull.vue')
    }
    , {
        path: '/account',
        component: require('./components/Account.vue')
    }
    , {
        path: '/api',
        component: require('./components/API.vue')
    }
]
Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue')
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue')
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue')
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
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '3px'
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
