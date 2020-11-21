import Vue from 'vue'
import VueRouter from 'vue-router'
// import Home from '../views/Home.vue'
import AddCompany from '../components/AddCompany.vue'
import CompanyUpdateDelete from '../components/CompanyUpdateDelete.vue'
import AddPersonelForm from '../components/AddPersonelForm.vue'
import PersonelUpdateDelete from '../components/PersonelUpdateDelete.vue'

Vue.use(VueRouter)
const routes = [
  {
    path: '/add-company',
    name: 'AddCompanyForm', // route name
    component: AddCompany
  },
    {
        path: '/',
        name: 'AddCompanyForm', // route name
        component: AddCompany
    },
    {
        path: '/company-update-delete',
        name: 'CompanyUpdateDelete',
        component: CompanyUpdateDelete
    },
    {
        path: '/personel-add',
        name: 'AddPersonelForm',
        component: AddPersonelForm
    },
    {
        path: '/personel-update-delete',
        name: 'PersonelUpdateDelete',
        component: PersonelUpdateDelete
    },
  {
    path: '/about',
    name: 'About',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/About.vue')
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
