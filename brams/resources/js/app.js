require('./bootstrap');
window.Vue = require('vue');
import VueRouter from 'vue-router'
Vue.use(VueRouter)
let routes = [
    {
        path: '/home'
        , component: require('./components/Home.vue')
    }
    , {
        path: '/dashboard'
        , component: require('./components/Dashboard.vue')
    }
    , {
        path: '/household'
        , component: require('./components/Household.vue')
    }
    , {
        path: '/inhabitant'
        , component: require('./components/Inhabitant.vue')
    }
    , {
        path: '/pet'
        , component: require('./components/Pet.vue')
    }
    , {
        path: '/garbage'
        , component: require('./components/Garbage.vue')
    }
    , {
        path: '/calendar'
        , component: require('./components/Calendar.vue')
    }
    , {
        path: '/barangayclearance'
        , component: require('./components/Barangayclearance.vue')
    }
]
const router = new VueRouter({
    mode: 'history'
    , routes
})
const app = new Vue({
    el: '#app'
    , router
});