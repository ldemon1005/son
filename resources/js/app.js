import Vue from 'vue'
import VueRouter from 'vue-router'

import IndexComponent from './components/IndexComponent'
Vue.use(VueRouter)

const router = new VueRouter({
    mode: 'history',
    routes: [
        { path: '/', component: IndexComponent },
    ]
})
console.log(router)

export default router
