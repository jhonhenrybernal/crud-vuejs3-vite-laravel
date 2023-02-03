import { createWebHistory, createRouter } from 'vue-router';
import login from './pages/login.vue';
import user from './pages/user.vue'
import client from './pages/client.vue'
import roles from './pages/roles.vue'
import product from './pages/product.vue'
import order from './pages/order.vue'
import store from './store'

const routes = [
    {
        path : '/',
        name : 'Login',
        component : login,
        meta:{
            requiresAuth:false
        }
    },
    {
        path : '/user',
        name : 'User',
        component : user,
        meta:{
            requiresAuth:true
        }
    },
    {
        path : '/client',
        name : 'Client',
        component : client,
        meta:{
            requiresAuth:true
        }
    },
    {
        path : '/roles',
        name : 'Roles',
        component : roles,
        meta:{
            requiresAuth:true
        }
    },
    {
        path : '/product',
        name : 'Product',
        component : product,
        meta:{
            requiresAuth:true
        }
    },
    {
        path : '/order',
        name : 'Order',
        component : order,
        meta:{
            requiresAuth:true
        }
    }

];

const router = createRouter({
    history: createWebHistory(),
    routes
});


router.beforeEach((to,from) =>{
    if(to.meta.requiresAuth && store.getters.getToken == 0){
        return { name : 'Login'}
    }
    if(to.meta.requiresAuth == false && store.getters.getToken != 0){
        return { name : 'User'}
    }
})

export default router;