export const routes = [{
    path: '/dashboard',
    component: require('./components/Dashboard.vue').default
  },
  {
    path: '/barangayclearance',
    component: require('./components/BarangayClearance.vue').default
  },
  {
    path: '/inhabitants',
    component: require('./components/Inhabitant.vue').default
  },
  {
    path: '/households',
    component: require('./components/Household.vue').default
  }]