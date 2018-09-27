require('./bootstrap');
window.Vue = require('vue');
window.Form = Form;
import {
    Form,
    HasError,
    AlertError
} from 'vform'
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
import VueRouter from 'vue-router'
Vue.use(VueRouter)
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
]
const router = new VueRouter({
    mode: 'history',
    routes
})
const app = new Vue({
    el: '#app',
    router
});
