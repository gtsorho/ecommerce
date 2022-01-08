import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/home.vue'
import About from '../views/about.vue'
import Product from '../views/product.vue'
import Cart from '../views/cart.vue'
import Details from '../views/details.vue'


const routes = [
    {
        path: '/',
        name: 'Home',
        component: Home,
    },
    {
        path: '/about',
        name: 'About',
        component: About
    },
    {
        path: '/product',
        name: 'Product',
        component: Product,
        props: true
    },
    {
        path: '/cart',
        name: 'Cart',
        component: Cart
    },
    {
        path: '/details',
        name: 'Details',
        component: Details
    },
]

    const router = createRouter({
    history: createWebHistory(),
    routes,
    scrollBehavior(to, from, savedPosition) {
        if (to.hash) {
            return {
            el: to.hash,
            top: 50,
            behavior: 'smooth',
            }
        }else{
            return {top: 0}
        }
    },
    })

    export default router
